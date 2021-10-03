<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Models\EmployeeAPI;
use App\Models\Employee;
use App\Models\BirthdayEmails;
use App\Mail\SendBirthdayEmail;

class SendBirthdayEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sendbirthdayemails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Birthday Emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();
        $employeeAPI = new EmployeeAPI();
        try {
            $employees = $employeeAPI->getAll();
            $birthdays = [];
            foreach ($employees as $employeeArray) {
                $employee = new Employee();
                try {
                    $employee->id = $employeeArray["id"];
                    $employee->name = $employeeArray["name"];
                    $employee->lastname = $employeeArray["lastname"];
                    $employee->dateOfBirth = $employeeArray["dateOfBirth"];
                    $employee->employmentStartDate = $employeeArray["employmentStartDate"];
                    $employee->employmentEndDate = $employeeArray["employmentEndDate"];
                }
                catch (\Exception $e) {
                    $this->error($e->getMessage());
                    continue;
//                    return 1;
                }
                /*
                $this->info($employee->id);
                $this->info($employee->name);
                $this->info($employee->lastname);
                $this->info($employee->dateOfBirth);
                $this->info($employee->employmentStartDate);
                $this->info($employee->employmentEndDate);
                */
                if ($employee->isBirthdayToday()) {
                    if (!BirthdayEmails::where(
                        [
                            ['employee_id', $employee->id],
                            ['sent', $today],
                        ]
                    )->exists()) {
                        $birthdays[] = $employee;
                    }
                }
//                break;
            }
            $birthdayCollection = collect($birthdays);
            if ($birthdayCollection->isNotEmpty()) {
                Mail::to(env('REALMDIGITAL_TO_ADDRESS'))->send(new SendBirthdayEmail($birthdayCollection));
                foreach ($birthdayCollection as $employee) {
                    BirthdayEmails::create([
                        'employee_id' => $employee->id,
                        'sent' => $today
                    ]);
                }
            }
            return 0;
        }
        catch (RequestException $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }
}

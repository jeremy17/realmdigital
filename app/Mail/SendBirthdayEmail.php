<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use App\Models\Employee;

class SendBirthdayEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $employees;

    public $names;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $employees)
    {
        $this->employees = $employees;
        $this->names = "";
        $comma = "";
        foreach ($employees as $employee) {
            $this->names = $this->names . $comma . $employee->name . ' ' . $employee->lastname;
            $comma = ", ";
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return
            $this->from('me@localhost.com', 'Happy Birthday!')
            ->view('emails.happybirthday');
    }
}

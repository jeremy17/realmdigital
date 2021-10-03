<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;

    public $id;
    public $name;
    public $lastname;
    public $dateOfBirth;
    public $employmentStartDate;
    public $employmentEndDate;

    public function isBirthdayToday() : bool
    {
//        $now = Carbon::parse('2021-10-28T00:00:00');
//        $now = Carbon::parse('2021-12-02T00:00:00');
        $now = Carbon::now();
        $dateOfBirth = Carbon::parse($this->dateOfBirth);
        if ($now->month == $dateOfBirth->month) {
            if (
                $now->month == 2
                && $now->day == 28
                && $dateOfBirth->day == 29
                && !$now->isLeapYear()
            ) {
                return true;

            } elseif ($now->day == $dateOfBirth->day) {
                return true;
            }
        }
        return false;
    }
}

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
        $today = Carbon::now();
        $dateOfBirth = Carbon::parse($this->dateOfBirth);
        if ($today->month == $dateOfBirth->month) {
            if (
                $today->month == 2
                && $today->day == 28
                && $dateOfBirth->day == 29
                && !$today->isLeapYear()
            ) {
                return true;

            } elseif ($today->day == $dateOfBirth->day) {
                return true;
            }
        }
        return false;
    }

    public function isCurrentlyEmployed() : bool
    {
        $today = Carbon::now();
        if (!is_null($this->employmentStartDate)) {
            $employmentStartDate = Carbon::parse($this->employmentStartDate);
            if ($today->lessThan($employmentStartDate))
                return false;
        }
        if (!is_null($this->employmentEndDate)) {
            $employmentEndDate = Carbon::parse($this->employmentEndDate);
            if ($today->greaterThan($employmentEndDate))
                return false;
        }
        return true;
    }
}

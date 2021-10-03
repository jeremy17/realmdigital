<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class EmployeeAPI extends Model
{
    use HasFactory;

    /**
     * @throws \Illuminate\Http\Client\RequestException
     */
    function getAll(): Collection
    {
        $response = Http::withOptions([
            'verify' => true
        ])->get('https://interview-assessment-1.realmdigital.co.za/employees');
        $response->throw();
        return $response->collect();
    }
}

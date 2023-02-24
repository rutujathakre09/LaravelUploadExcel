<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'name',
        'job_title',
        'department',
        'business_unit',
        'gender',
        'age',
        'joining_date',
        'annual_salary',
        'country',
        'city' 
    ];
}

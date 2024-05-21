<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = 'employees';

    protected $fillable = ['id','employee_id','first_name', 'last_name', 'job_title', 'department', 'phone', 'email', 'image', 'birth_date'];
}

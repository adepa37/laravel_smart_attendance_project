<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = ['id', 'employee_id', 'date', 'check_in', 'check_in_time', 'check_out', 'check_out_time', 'late', 'on_leave'];
    
}

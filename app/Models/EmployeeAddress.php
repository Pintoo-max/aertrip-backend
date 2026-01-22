<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'employee_addresses'; 
    protected $fillable = ['employee_id','address','country','state','city','pincode'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeContact extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'employee_contacts'; 
    protected $fillable = ['employee_id','contact_number','type'];
}

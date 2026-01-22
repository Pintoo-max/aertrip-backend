<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Employee extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'employees'; 
    protected $fillable = ['department_id','first_name','last_name','email'];

    public function  department()
    {
        return $this->belongsTo(Department::class);
    }

    public function contacts()
    {
        return $this->hasMany(EmployeeContact::class);
    }

    public function addresses()
    {
        return $this->hasMany(EmployeeAddress::class);
    }

}

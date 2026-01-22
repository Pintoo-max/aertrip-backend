<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Department extends Model
{
    //
    protected $connection = 'mysql';
    protected $table = 'departments'; 
    protected $fillable = ['department_name','department_description'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}

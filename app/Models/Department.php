<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    //
    
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'departments'; 
    protected $fillable = ['department_name','department_description'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}

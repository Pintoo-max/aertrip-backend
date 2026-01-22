<?php
use App\Http\Controllers\Api\EmployeeController;

Route::apiResource('v1/employees',EmployeeController::class);
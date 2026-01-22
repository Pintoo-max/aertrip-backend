<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    public function __construct(private EmployeeService $service) {

    }

    public function index(Request $request)
    {
        try {

            return EmployeeResource::collection($this->service->list($request->all()));

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something wrent wrong contact to administrator!',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);

        }
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {

            return new EmployeeResource($this->service->store($request->validated()));

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something wrent wrong contact to administrator!',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);

        }
        
    }

    public function show($id)
    {
        try {

            return new EmployeeResource($this->service->show($id));

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something wrent wrong contact to administrator!',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);

        }
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        try {

            $employee = $this->service->update($id, $request->validated());
            return new EmployeeResource($employee);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something wrent wrong contact to administrator!',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);

        }
    }

    public function destroy($id)
    {
        try {

            $this->service->destroy($id);
            return response()->json(['message'=>'Employee Removed successfully with its contacts and addressess']);


        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something wrent wrong contact to administrator!',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);

        }
    }
}
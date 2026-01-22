<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function __construct(private EmployeeService $service) {

    }

    public function index(Request $request)
    {
        return EmployeeResource::collection($this->service->list($request->all()));
    }

    public function store(StoreEmployeeRequest $request)
    {
        return new EmployeeResource($this->service->store($request->validated()));
    }

    public function show($id)
    {
        return new EmployeeResource($this->service->show($id));
    }

    public function update(StoreEmployeeRequest $request,$id)
    {
        return new EmployeeResource($this->service->update($id,$request->validated()));
    }

    public function destroy($id)
    {
        $this->service->destroy($id);
        return response()->json(['message'=>'Deleted']);
    }
}
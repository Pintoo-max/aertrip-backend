<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class EmployeeRepository implements EmployeeRepositoryInterface
{
	public function paginate(array $filters)
	{
		return Employee::with(['department','contacts','addresses'])

		->when($filters['name'] ?? null, fn($q,$v)=>$q->where('first_name','like',"%$v%"))
		->when($filters['department_id'] ?? null, fn($q,$v)=>$q->where('department_id',$v))
		->paginate(10);
	}

	public function create(array $data)
	{
		return DB::transaction(function () use ($data) {
		$employee = Employee::create($data);
		$employee->contacts()->createMany($data['contacts']);
		$employee->addresses()->createMany($data['addresses']);
		return $employee;
		});
	}

	public function find(int $id)
	{
		return Employee::with(['department','contacts','addresses'])->findOrFail($id);
	}

	public function update(int $id, array $data)
	{
	    return DB::transaction(function () use ($id, $data) {
	        // Fix: Call the local find() method
	        $employee = $this->find($id);


	        $employee->update(Arr::only($data, ['first_name', 'last_name', 'email', 'department_id']));

	        if (!empty($data['contacts'])) {
	            foreach ($data['contacts'] as $contactData) {
	                if (!empty($contactData['id'])) {
	                    // Update existing contact
	                    $employee->contacts()
	                        ->where('id', $contactData['id'])
	                        ->update(Arr::only($contactData, ['contact_number', 'type']));
	                } else {
	                    // Create new contact
	                    $employee->contacts()->create(Arr::only($contactData, ['contact_number', 'type']));
	                }
	            }

	            $requestIds = collect($data['contacts'])->pluck('id')->filter()->all();
	            if (!empty($requestIds)) {
	                $employee->contacts()->whereNotIn('id', $requestIds)->delete();
	            }
	        }

	        if (!empty($data['addresses'])) {
	            foreach ($data['addresses'] as $addressData) {
	                if (!empty($addressData['id'])) {
	                    // Update existing address
	                    $employee->addresses()
	                        ->where('id', $addressData['id'])
	                        ->update(Arr::only($addressData, ['address','city','state','pincode','country']));
	                } else {
	                    // Create new address
	                    $employee->addresses()->create(Arr::only($addressData, ['address','city','state','pincode','country']));
	                }
	            }

	            // Delete addresses not present in request (optional)
	            $requestIds = collect($data['addresses'])->pluck('id')->filter()->all();
	            if (!empty($requestIds)) {
	                $employee->addresses()->whereNotIn('id', $requestIds)->delete();
	            }
	        }

	        return $employee;
	    });
	}

	public function delete(int $id)
	{
		return Employee::destroy($id);
	}
}
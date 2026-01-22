<?php

namespace app\Repositories\Eloquent;

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
		return DB::transaction(function () use ($id,$data) {
		$employee = $this->find($id);
		$employee->update($data);
		return $employee;
		});
	}

	public function delete(int $id)
	{
		return Employee::destroy($id);
	}
}
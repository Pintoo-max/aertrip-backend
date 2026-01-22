<?php

namespace App\Services;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class EmployeeService
{
	protected EmployeeRepositoryInterface $employeeRepository;
	// public function __construct(private EmployeeRepositoryInterface $repo)
	// {

	// }

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->repo = $employeeRepository;
    }

	public function list(array $filters)
	{
		return $this->repo->paginate($filters);
	}


	public function store(array $data)
	{
		return $this->repo->create($data);
	}


	public function show(int $id)
	{
		return $this->repo->find($id);
	}


	public function update(int $id, array $data)
	{
		return $this->repo->update($id,$data);
	}


	public function destroy(int $id)
	{
		return $this->repo->delete($id);
	}
}
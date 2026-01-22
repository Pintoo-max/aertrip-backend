<?php

namespace App\Repositories\Contracts;

interface EmployeeRepositoryInterface
{
	public function paginate(array $filters);

	public function create(array $data);
	
	public function find(int $id);
	
	public function update(int $id, array $data);
	
	public function delete(int $id);
}
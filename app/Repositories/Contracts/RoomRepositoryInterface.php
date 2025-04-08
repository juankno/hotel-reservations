<?php

namespace App\Repositories\Contracts;

interface RoomRepositoryInterface
{
    public function all(array $filters = []) : \Illuminate\Pagination\LengthAwarePaginator;
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}

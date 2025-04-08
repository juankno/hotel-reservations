<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->user->find($id);
        return $model ? tap($model)->update($data) : false;
    }

    public function delete($id)
    {
        $model = $this->user->find($id);
        return $model ? $model->delete() : false;
    }
}

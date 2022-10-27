<?php


namespace App\Repositories\User;


use App\Models\User;

class UserRepository implements UserInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->where('type','!=','provider')->get();
    }

    public function getByID($id)
    {
        // TODO: Implement getByID() method.
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        $attributes['type'] = 'user';
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
        $module = $this->model->findOrFail($id);
        $module->update($attributes);
        $module->save();
        return $module;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $module = $this->getByID($id);
        return $module->delete();
    }
}
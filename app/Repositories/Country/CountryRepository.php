<?php


namespace App\Repositories\Country;


use App\Models\Country;

class CountryRepository implements CountryInterface
{
    public function __construct(Country $country)
    {
        $this->model = $country;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    public function getByID($id)
    {
        // TODO: Implement getByID() method.
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
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
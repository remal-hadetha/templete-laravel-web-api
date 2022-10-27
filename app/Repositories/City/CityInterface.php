<?php


namespace App\Repositories\City;


interface CityInterface
{
    public function getAll();
    public function getByID($id);
    public function create(array $attributes);
    public function update($id,array  $attributes);
    public function delete($id);
}
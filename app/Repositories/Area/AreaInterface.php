<?php


namespace App\Repositories\Area;


interface AreaInterface
{
    public function getAll();
    public function getByID($id);
    public function create(array $attributes);
    public function update($id,array  $attributes);
    public function delete($id);
}
<?php


namespace App\Repositories\Product;


use App\Models\Product;
use Illuminate\Support\Arr;
class ProductRepository implements ProductInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
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
        $image_name = time(). $attributes['image']->getClientOriginalName();
        $attributes['image']->move(storage_path('app/public/uploads/products/'),$image_name);
        $attributes['img'] = $image_name;
        return $this->model->create(Arr::except($attributes,['image']));
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
        $module = $this->model->findOrFail($id);
        $image_name = time(). $attributes['image']->getClientOriginalName();
        $attributes['image']->move(storage_path('app/public/uploads/products/'),$image_name);
        $attributes['img'] = $image_name;
        $module->update(Arr::except($attributes,['image']));
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
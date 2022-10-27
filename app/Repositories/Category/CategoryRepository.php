<?php


namespace App\Repositories\Category;


use App\Models\Category;
use Illuminate\Support\Arr;

class CategoryRepository implements CategoryInterface
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->where('category_id',null)->get();
    }

    public function getByID($id)
    {
        // TODO: Implement getByID() method.
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        // TODO: Implement create() method.
        if(Arr::exists($attributes,'image')){

        $image_name = time() . $attributes['image']->getClientOriginalName();
        $attributes['image']->move(storage_path('app/public/uploads/categories/'),$image_name);
        $attributes['img'] = $image_name;
         }

        return $this->model->create(Arr::except($attributes,['image','back_image']));
    }

    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
        if(Arr::exists($attributes,'image')){
            $image_name = time() . $attributes['image']->getClientOriginalName();
            $attributes['image']->move(storage_path('app/public/uploads/categories/'),$image_name);
            $attributes['img'] = $image_name;
        }

        $module = $this->model->findOrFail($id);
        $module->update(Arr::except($attributes,['image','back_image']));
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

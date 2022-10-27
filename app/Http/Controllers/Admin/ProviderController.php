<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\Provider\ProviderRequest;

use App\Repositories\Provider\ProviderRepository;
use App\Repositories\Category\CategoryRepository;

use App\Repositories\City\CityRepository;

class ProviderController extends Controller
{
    private $model;
    private $city;
    private $category;
    private $page;
    private $url;
    private $route;
    private $data;
    public function __construct(ProviderRepository $provider,CityRepository $city,CategoryRepository $category)
    {
        $this->model = $provider;
        $this->city = $city;
        $this->category = $category;
        $this->page  = 'dashboard.cruds.providers.';
        $this->url   = '/providers';
        $this->route = 'providers.index';
        $this->data  = [];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->model->getAll();
        return view($this->page.'index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->getAll();

        return view($this->page.'create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        $this->model->create($request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data added messages']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->getByID($id);
        return view($this->page.'ajax.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->getByID($id);
        $categories = $this->category->getAll();

        return view($this->page.'edit',compact('data','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, $id)
    {
        $this->model->update($id,$request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data added messages']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data Deleted successfully']);
    }
}

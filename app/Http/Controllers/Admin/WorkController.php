<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkRequest;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    private $model;
    private $user;
    private $page;
    private $url;
    private $route;
    private $data;
    public function __construct(User $user,Work $work)
    {
        $this->model = $work;
        $this->user = $user;
        $this->page  = 'dashboard.cruds.works.';
        $this->url   = '/works';
        $this->route = 'works.index';
        $this->data  = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->get();
        return view($this->page.'index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->user->where('type','provider')->get();
        return view($this->page.'create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request)
    {
        $image_name = time(). $request['image']->getClientOriginalName();
        $request['image']->move(storage_path('app/public/uploads/works/'),$image_name);
        $data['image'] = $image_name;
        $data['salon_id'] = $request->salon_id;
        $this->model->create($data);
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
        $data = $this->model->find($id);
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
        $data = $this->model->find($id);
        $users = $this->user->where('type','provider')->get();
        return view($this->page.'edit',compact('data','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkRequest $request, $id)
    {
        $work = Work::find($id);
        if($request['image']){
            $image_name = time(). $request['image']->getClientOriginalName();
            $request['image']->move(storage_path('app/public/uploads/works/'),$image_name);
            $data['image'] = $image_name;
        }
        $data['salon_id'] = $request->salon_id;
        $work->update($data);
        $work->save();
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
        $work = Work::find($id);
        $work->delete();
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data Deleted successfully']);
    }
}

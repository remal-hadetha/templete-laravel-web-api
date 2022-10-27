@extends('dashboard.layout.layout')
@section('content')
 <!-- Dynamic Table with Export Buttons -->
 @if(session('message'))
 @if(session('message')['type'] == 'success')
    <div class="col-xl-12 alert alert-dismissible alert-success fade show" role="alert">
        {{ session('message')['content']  }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
 @endif
 @endif
 <div class="block">
    <div class="block-header">
        <h3 class="block-title"> الآقسام الفرعيه <small></small></h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;"></th>
                    <th>الإسم</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;"> الوصف</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;"> القسم الرئيسي</th>

                    <th style="width: 15%;"> تاريخ التسجيل </th>
                    <th style="width: 15%;">   </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                    <td class="font-w600 font-size-sm">
                    <a href="{{route('admins.show',$item->id)}}">{{$item->name_ar}}</a>
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->desc_ar}}
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->maincategory->name_ar}}
                    </td>
                    <td>
                        <em class="text-muted font-size-sm">{{$item->created_at->diffForHumans()}}</em>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            
                            <a href="{{route('subcategories.edit',$item->id)}}" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <form action="{{route('subcategories.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-primary"  title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty
                    
                @endforelse

            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table with Export Buttons -->
@endsection

@section('js')
<script src="{{asset('/')}}js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.print.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.html5.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.flash.min.js"></script>
<script src="{{asset('/')}}js/plugins/datatables/buttons/buttons.colVis.min.js"></script>

<!-- Page JS Code -->
<script src="{{asset('/')}}js/pages/be_tables_datatables.min.js"></script>
@endsection
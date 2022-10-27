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
        <h3 class="block-title">  عمليات الدفع <small></small></h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;"></th>
                    <th> رقم الحجز</th>
                    <th>صاحب الحجز</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">  الصالون  </th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">  قيمة الحجز</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">  قيمة الكوبون</th>
                    <th style="width: 15%;"> تاريخ التسجيل </th>
                    <th style="width: 15%;">   </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                    <td class="font-w600 font-size-sm">
                    <a href="{{route('payments.show',$item->id)}}">{{$item->order->id}}</a>
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->order->user->name}}
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->order->salon->name}}
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{$item->order->sub_total}}
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        @if ($item->order->coupoun_id != null)
                            {{$item->order->coupon->value}}
                            @else
                            غير مستخدم
                        @endif
                    </td>

                    <td>
                        <em class="text-muted font-size-sm">{{$item->created_at->diffForHumans()}}</em>
                    </td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('payments.show',$item->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" title="عرض">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>

                            <form action="{{route('payments.destroy',$item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"  title="حذف">
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

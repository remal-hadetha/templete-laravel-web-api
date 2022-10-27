@extends('dashboard.layout.layout')
@section('content')
<form  action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('dashboard.cruds.categories.form')
</form>
@endsection

@section('css')
        <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{asset('/')}}js/plugins/select2/css/select2.min.css">

@endsection

@section('js')
<script src="{{asset('/')}}js/plugins/select2/js/select2.full.min.js"></script>
<script src="{{asset('/')}}js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('/')}}js/plugins/jquery-validation/additional-methods.js"></script>

<!-- Page JS Helpers (Select2 plugin) -->
<script>jQuery(function(){ One.helpers('select2'); });</script>

<!-- Page JS Code -->
<script src="{{asset('/')}}js/pages/be_forms_validation.min.js"></script>
@endsection
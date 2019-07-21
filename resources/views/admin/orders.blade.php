@extends('admin/template')

@section('title', 'Orders')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('admin_orders_add') }}" class="btn btn-primary float-right">Add order</a>
    </div>
</div>
    <div id="app">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />
        <orders></orders>
    </div>
@endsection

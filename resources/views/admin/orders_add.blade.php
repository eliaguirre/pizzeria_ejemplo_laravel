@extends('admin/template')

@section('title', 'Add Order')

@section('content')
    <div id="app">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />
        <venta></venta>
    </div>
@endsection

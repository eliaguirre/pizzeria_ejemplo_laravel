@extends('venta/template')

@section('title', 'Venta')

@section('content')
    <div id="app">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />
        <venta></venta>
    </div>
@endsection

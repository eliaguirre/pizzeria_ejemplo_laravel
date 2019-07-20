@extends('admin/template')

@section('title', 'Users')

@section('content')
    <div id="app">
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}" />
        <users/>
    </div>
@endsection

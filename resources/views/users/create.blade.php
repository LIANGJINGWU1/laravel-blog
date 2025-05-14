@extends('layouts.default')
@section('title', '注册')

@section('content')
    <h1>注册</h1>

    <form method="POST" action="{{ route('users.store') }}">
    @csrf
        <div class = "mb-3">
            <label for="name">名称</label>
            <input type="text" name = "name" class="form-control" value="old{{old('name')}}">
        </div>
        <div class = "mb-3">

        </div>
        <div class = "mb-3">

        </div>
    </form>
@stop

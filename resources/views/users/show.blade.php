@extends('layouts.default')
@section('title', $user->name)

@section('content')
    <div class="row">
        <div class="offset-md-2 col-md-8">
            <div class="col-md-12">
                <div class="offset-md-2 col-md-8">
                    <section class="user_info">
{{--                        子模板引入（@include）语法,引入 resources/views/shared/_user_info.blade.php 文件
                            并把当前变量 $user 传进去作为子模板的 user--}}
                        @include('shared._user_info', ['user' => $user])
                    </section>
                </div>
            </div>
        </div>
    </div>
@stop

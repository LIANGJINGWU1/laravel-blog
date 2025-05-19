@extends('layouts.default')

@section('content')
    <div class="bg-light p-3 p-sm-5 rounded">

            @if(!Auth::check())
                <div class = "row mt-5">
                    <div class = "col-md-8">
                        <section class="status_form">
                            @include('shared._status_form')
                        </section>
                </div>
                    <aside class = "col-md-4">
                        <section class = "user_info">
                            @include('shared._user_info', ['user' => Auth::user()])
                        </section>
                    </aside>
                </div>

            @else
                <div class = "bg-light p-3 p-sm-5 rounded mt-5">
                    <h1>Hi</h1>
                    <p class="lead">
                        欢迎访问<b>liang blog</b>
                    </p>
                    <a class="btn btn-lg btn-success"
                       href="{{ route('signup') }}" role="button">现在注册</a>
                </div>
    </div>
@stop

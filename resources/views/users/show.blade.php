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

                    @if(Auth::check())
                        @include('users._follow_form')
                    @endif

                    <section class="stats mt-2">
                        @include('shared._stats', ['user' => $user])
                    </section>
                    <section class="status">
                        @if($statuses->isNotEmpty())
                            <ul class="list-unstyled">
                                @foreach($statuses as $status)
                                    @include('statuses._status')
                                @endforeach
                            </ul>
                            <div class="mt-5">
                                {!! $statuses->links() !!}
                            </div>
                        @else
                            <p>没有数据</p>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
@stop

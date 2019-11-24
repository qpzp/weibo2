@extends('layouts.default')
@section('title','主✌')
@section('content')
  @if(Auth::check())
    <div class="row">
      <div class="col-md-8">
        <section class="status_form">
          @include('shared._status_form')
        </section>
        <h4>微博列表</h4>
        @include('shared._feed')
      </div>
      <aside class="col-md-4">
        <section class="user_info">
          @include('shared._user_info',['user'=>Auth::user()])
        </section>
      </aside>
    </div>
  @else
    <div class="jumbotron">
      <h1 class="display-4">她不停的旋转</h1>
      <p class="lead">在空荡的舞台</p>
      <hr class="my-4">
      <a class="btn btn-primary btn-lg" href="{{route('signup')}}" role="button">注册</a>
    </div>
  @endif
@stop

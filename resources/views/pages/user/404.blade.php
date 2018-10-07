@extends('userlayout.design')



@section('content')

<div class="container text-center">
    <div class="content-404">
        <h1><b>Opps!</b>we couid not find this page</h1>
        <p>We can not find the page you're looking for.</p>
        <a class="btn btn-warning btn-big" href="{{route('index')}}">Back to Home</a>
    </div>
</div>
@endsection
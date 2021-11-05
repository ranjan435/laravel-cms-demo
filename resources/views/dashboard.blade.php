@extends('master')
@section('content')  

<main class="container px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>
    <div class="row row-cols-1 row-cols-md-6 text-center">
        <div class="col-sm-6">
            <div class="card h-100"> 
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <h1 class="card-text">{{$posts}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <h1 class="card-text">{{$users}}</h1>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
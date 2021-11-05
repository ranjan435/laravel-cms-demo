@extends('master')
@section('content')
<div class="container mt-3">
    <div class="row">
        <form action="/updateprofile" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$user['id']}}" id="id" name="id">
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" value="{{$user['name']}}" name="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" value="{{$user['email']}}" name="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="type" class="form-label">User Type</label>
                <div class="col-sm-10">
                    <select class="form-select" name="type" id="type">
                        <option value="admin" {{$user['type']=="admin"? "selected": ""}}>Admin</option>
                        <option value="member" {{$user['type']=="member"? "selected": ""}}>Member</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="avatar" class="form-label">Avatar</label>
                <div class="col-sm-10">
                    @isset($user['avatar'])
                    <img src="{{url('/images/avatar/'.$user['avatar'])}}" alt="{{$user['avatar']}}" height="200px">
                    @endif
                    <input type="file" name="image" class="form-control" id="avatar">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
  </div>
</div>  
@endsection
@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">    
            <form action="addUser" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="exampleInputName" class="form-label">User Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputUserType" class="form-label">User Type</label>
                    <select class="form-select" aria-label="Default select example" name="userType" id="exampleInputUserType">
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                </div>
                <div class="mb-3 row">
                    <label for="avatar" class="form-label">Avatar</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" class="form-control" id="avatar">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
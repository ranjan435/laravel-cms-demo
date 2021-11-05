@extends('base')
@section('content')    
    <div class="container">
        <div class="row">
            <form action="register" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">User Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
@endsection
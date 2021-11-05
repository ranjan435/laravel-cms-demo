<?php 
    use App\User;
    $users = User::all();
?>
@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">    
            <form action="/update" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$post['id']}}" id="id" name="id">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{$post['title']}}">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea id="content" name="content" rows="4" cols="120" class="form-control" value="{{$post['content']}}"></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option value="pending" {{$post['status']=="pending"? "selected":""}}>Pending</option>
                        <option value="published" {{$post['status']=="published"? "selected":""}}>Published</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="posted_by" class="form-label">Posted By</label>
                    <select class="form-select" aria-label="Default select example" name="posted_by" id="posted_by">
                        @foreach($users as $user)
                            @if($user['id']==$post['posted_by'])
                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 row">
                    <label for="image" class="form-label">Image</label>
                    @isset($post['image'])
                    <img src="{{url('/images/post/'.$post['image'])}}" alt="{{$post['image']}}" height="200px">
                    @endif
                    <div class="col-sm-10">
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
<?php 
    use App\Post;
    use App\User;

    $posts = Post::all();
?>

@extends('base')
@section('content')
    <main class="container">
        <article class="blog-post">
        <h1>All Posts</h1>
            @foreach($posts as $post)
                <div class="post p-4 mb-3 bg-light rounded row post-list">
                    <div class="col-sm-6">
                        <h2 class="blog-post-title"><a href="/postdetail/{{$post['id']}}">{{$post["title"]}}</a></h2>
                        <em class="blog-post-meta">Posted on <?php echo date("jS F ",strtotime($post["created_at"])) . " by " . "<a href=\"#\">" . User::find($post['posted_by'])['name'] ."</a></em>";?>
                        <br><br>
                        <p>{{$post["content"]}}</p>
                    </div>
                    <div class="col-sm-6">
                        <img src="{{url('/images/post/'.$post['image'])}}" class="mb-2" alt="{{$post['image']}}" width="30%">
                    </div>
                </div>
            @endforeach
        </article>
    </main>
@endsection
   
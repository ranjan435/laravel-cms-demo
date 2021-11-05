<?php 
    use App\User;
?>
@extends('base')
@section('content')
    <main class="container">
        <article class="blog-post">
            <h1>Detailed Post</h1>
            <div class="post p-4 mb-3 bg-light rounded">
                <img src="{{url('/images/post/'.$post['image'])}}" class="mb-2" alt="{{$post['image']}}" width="50%">
                <h2 class="blog-post-title">{{$post["title"]}}</h2>
                <em class="blog-post-meta">Posted on <?php echo date("jS F ",strtotime($post["created_at"])) . " by " . "<a href=\"#\">" . User::find($post['posted_by'])['name'] ."</a></em>";?>
                    <br><br>
                    <p>{{$post["content"]}}</p>
            </div>
        </article>
    </main>
</body>
</html>
@endsection

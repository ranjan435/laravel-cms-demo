<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use DB;
use Yajra\Datatables\Datatables;

class PostController extends Controller
{
    function createPost(Request $req){
        $post = new Post;
        $post->title = $req->title;
        $post->content = $req->content;
        $post->status = $req->status;
        $post->posted_by = intval($req->posted_by);

        //image upload
        if(isset($req->image)){
            $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $title = $req->title;
            $user_id = $req->posted_by;
            $user_name = User::find($user_id)['name'];
            $imageName = $user_name."_".$title.'_'.time().'.'.$req->image->extension();  
            $req->image->move(public_path('images/post'), $imageName);
            $post->image = $imageName;
        }
        $post->save();
        return redirect('/posts');
    }

    function getPost($id){
        $data = Post::find($id);
        return view('post',['post'=>$data]);
    }

    function updatePost(Request $req){
        $post = Post::find($req->id);
        $post->title = $req->title;
        $post->content = $req->content;
        $post->status = $req->status;
        $post->posted_by = intval($req->posted_by);

        //image upload
        if(isset($req->image)){
            $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $title = $req->title;
            $user_id = $req->posted_by;
            $user_name = User::find($user_id)['name'];
            $imageName = $user_name."_".$title.'_'.time().'.'.$req->image->extension();  
            $req->image->move(public_path('images/post'), $imageName);
            $post->image = $imageName;
        }
        $post->save();
        return redirect('/posts');
    }

    function deletePost($id){
        Post::destroy($id);
        return redirect('/posts');
    }

    //DATATABLES
    function index(Request $request){
        if($request->session()->has('user')){
            return view('posts');
        }
        else{
            return redirect('/login');
        }  
    }

    public function getPosts(Request $request){
        if($request->session()->has('user')){
            if ($request->ajax()){
                $user = $request->session()->get('user');
                if($user['type']=="admin"){
                    $data = DB::table('posts')
                        ->join('users','posts.posted_by','=','users.id')
                        ->select('users.name','posts.*');//Posts::latest()
                }
                else{
                    $data = Post::where(['posted_by'=>$user['id']])
                        ->join('users','posts.posted_by','=','users.id')
                        ->select('users.name','posts.*');//Posts::latest()
                }
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="post/'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="delete/'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
        else{
            return redirect('/login');
        }       
    }

    function postdetail($id){
        $post = Post::find($id);
        return view('postdetail',['post'=>$post]);
    }

    function dashboard(Request $req){
        if($req->session()->has('user')){
            $user = $req->session()->get('user');
            if($user['type']=="admin"){
                $users = User::all()->count();
                $posts = Post::all()->count();
                return view('dashboard',['users'=>$users,'posts'=>$posts]);
            }
            else{
                $posts = Post::where(['posted_by'=>$user['id']])->count();
                return view('dashboard',['users'=>1,'posts'=>$posts]);
            }
        }
        else{
            return redirect('/login');
        }
    }
}

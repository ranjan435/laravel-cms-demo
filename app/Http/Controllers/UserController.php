<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use DB;
class UserController extends Controller
{
    function login(Request $req){
        $user = User::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return "Username or password is not matched";
        }
        else{
            $req->session()->put('user',$user);
            return redirect('/home');
        }
    }

    function register(Request $req){
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->type = $req->userType;
        $user->save();
        return redirect('/login');
    }

    function getUser($id){
        $data = User::find($id);
        return view('user',['user'=>$data]);
    }

    function editUser(Request $req){
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->type = $req->type;
        //image upload
        if(isset($req->image)){
            $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $name = $req->name;
            $imageName = $name."_".time().'.'.$req->image->extension();  
            $req->image->move(public_path('images/avatar'), $imageName);
            $user->avatar = $imageName;
        }
        $user->save();
        return redirect('/users');
    }
    
    function deleteUser(Request $req){
        User::destroy($id);
        return redirect('/users');
    }

    function addUser(Request $req){
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->type = $req->userType;
        //image upload
        if(isset($req->image)){
            $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $name = $req->name;
            $imageName = $name."_".time().'.'.$req->image->extension();  
            $req->image->move(public_path('images/avatar'), $imageName);
            $user->avatar = $imageName;
        }
        $user->save();
        return redirect('/users');
    }

    function profile(Request $req){
        if($req->session()->has('user')){
            $id = $req->session()->get('user')['id'];  
            $user = User::where(['id'=>$id])->first();  
            return view('profile',['user'=>$user]);
        }
        else{
            return redirect('/login');
        }
    }

    function updateProfile(Request $req){
        // return $req->input();
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->type = $req->type;
        //image upload
        if(isset($req->image)){
            $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $name = $req->session()->get('user')['name'];
            $imageName = $name."_".time().'.'.$req->image->extension();  
            $req->image->move(public_path('images/avatar'), $imageName);
            $user->avatar = $imageName;
        }
        $user->save();
        return redirect('/profile');
        //     // ->with('success','You have successfully upload image.')
        //     // ->with('image',$imageName); 
    }

    //DATATABLES
    function index(Request $request){
        if($request->session()->has('user')){
            return view('users');
        }
        else{
            return redirect('/login');
        }  
    }
 

    public function getUsers(Request $request){
        if($request->session()->has('user')){
            if ($request->ajax()){
                $user = $request->session()->get('user');
                if($user['type']=="admin"){
                    $data = DB::table('users');//Users::latest()
                }
                else{
                    $data = User::where(['id'=>$user['id']]);
                }
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="user/'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="delete/'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
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
}

<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class TrashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function get_trash(){
        $trashposts = Post::onlyTrashed()->get();
        return view('posts.trash')->with('trashposts',$trashposts);
    }

    public function delete_trash($id){
        $trashpost = Post::onlyTrashed()->where('id',$id)->first();

        // dd($trashpost);
        if(Auth::user()->id !== $trashpost->user_id){
            return back()->with('error','you cant delete other post');
        }
        $trashpost->forceDelete();
        return back()->with('success','Post delete successfuly..');
    }

    public function restore_trash($id){
        $trashpost = Post::onlyTrashed()->where('id',$id)->first();

        if(Auth::user()->id !== $trashpost->user_id)
            return back()->with('error','you cant delete other post');
        
        $trashpost->restore();
        return back()->with('success','Post restore successfuly..');
    }
}

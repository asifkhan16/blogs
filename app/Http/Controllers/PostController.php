<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class PostController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = post::all();
        // return DB::select('Select * from posts');
        // return Post::where('id','5')->get();
        // return Post::orderBy('title','desc')->take(1)->get();  use to get one post
        // $posts = Post::orderBy('created_at','desc')->get(); //desc for decending
        $posts =Post::OrderBy('created_at','desc')->paginate(4);
        // $id = Auth::user()->id;
        // $user = User::find($id);
        return view('posts.home')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.createpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|max:1999'
        ]);

        // handle file upload
        if($request->hasFile('cover_image')){
              // get file name with extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // get just file
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get the extention
            $fileExtention = $request->file('cover_image')->getClientOriginalExtension();
            // file name to be store
            $fileNameToStore = $filename.'_'.time().'.'.$fileExtention;
            // upload image
            $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
        }
        else{
            $fileNameToStore = "noimage.jpg";
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        
        return back()->with('success',"Post created successfuly...");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.showpost')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Post::Where('id',$id)->exists()){
            return redirect('dashboard')->with('error',"No record found...");
        }
        $post = Post::find($id);
        if(Auth::user()->id !== $post->user_id){
            return redirect('dashboard')->with('error','You can not edit other post');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
             'title' => 'required',
             'body' => 'required',
             'cover_image' => 'image|max:1999'
        ]);
        
        if($request->hasFile('cover_image')){
            // get file name with extention
          $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
          // get just file
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          // get the extention
          $fileExtention = $request->file('cover_image')->getClientOriginalExtension();
          // file name to be store
          $fileNameToStore = $filename.'_'.time().'.'.$fileExtention;
          // upload image
          $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            Storage::delete('public/cover_image'.$post->cover_image);
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        
        return redirect('dashboard')->with('success','Post Update successfuly..');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Post::where('id',$id)->exists()){
            return redirect('dashboard')->with('error','No recored found...');
        }
         
        $post = Post::find($id);
        if(Auth::user()->id !== $post->user_id){
            return redirect('dashboard')->with('error','You Can not delete other user Post');
        }
        if($post->cover_image !== 'noimage.jpg')
        {
            Storage::delete(asset('public/cover_image'.$post->cover_image));
        }
        $post->delete();
        return back()->with('success','Post delete successfuly...');
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::all();

        if ($categories->count() ==0) {
            
            Session::flash('info', 'You MusT Have Some categories Before Creating a Post');
            return redirect()->back();
        }
        return view('admin.posts.create', compact('categories','tags'));
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
            'featured' => 'required|image',
            'content' => 'required',
            'category_id' => 'required',
            'tags' =>'required'
            


         ]);

         $slug =str_slug($request->title);

         $featured = $request->featured;

         $featured_new_name = time().$featured->getClientOriginalName();

         $featured->move('uploads/posts', $featured_new_name);


         $post = new Post();

         $post->title =$request->title;
         $post->slug = $slug;
         $post->content =$request->content;
         $post->featured ='uploads/posts/'.$featured_new_name;
         $post->category_id =$request->category_id;


         
         $post->save();

         $post->tags()->attach($request->tags);

         Session::flash('success', 'Post Created Succesfully');
         return redirect()->route('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($id);
        return view('admin.posts.edit',compact('categories', 'tags', 'post'));
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
            'content' => 'required',
            'category_id' => 'required',
            


         ]);

         $post =Post::find($id);

         if ($request->hasFile('featured')) {
             
         $featured = $request->featured;

         $featured_new_name = time().$featured->getClientOriginalName();

         $featured->move('uploads/posts', $featured_new_name);

         $post->featured ='uploads/posts/'.$featured_new_name;

         }


         $post->title =$request->title;
         $post->content =$request->content;
         $post->category_id =$request->category_id;


         $post->save();

         $post->tags()->sync($request->tags);

         Session::flash('success', 'Post Updated Succesfully');
         return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        Session::flash('success', 'Post Just Move To Trash');

        return redirect()->back();
    }


    public function trashed(){
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed', compact('posts'));

    }

    public function kill($id){
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->forceDelete();

        Session::flash('success', 'Post deleted Permanently');

        return redirect()->back();

    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();

        Session::flash('success', 'Post Restore Successfully');

        return redirect()->route('posts');

    }
}

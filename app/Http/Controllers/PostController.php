<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    //
    protected function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }
    public function index(){
        //$posts = Post::all();
        $posts = auth()->user()->posts()->paginate(5);
        foreach($posts as $post){
            $post->post_image = $this->getPostImageAttribute($post->post_image); 
        }
        return view('admin.posts.index',['posts'=> $posts]);
    }
    public function show(Post $post){
        //dd($post);
        //Post::findOrFail($id);
        return view('blog-post', ['post'=>$post]);
    }
    public function create(){

        return view('admin.posts.create');
    }
    public function store(){
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        
        if($file = request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            //$name = $file->getClientOriginalName();
            //$file->move('images', $name);
            //$input['post_image'] = $name;
        }
       auth()->user()->posts()->create($inputs);
       Session::flash('post-created-message', 'Post with title '.$inputs['title'].' was created');
        return redirect()->route('post.index');
        //FROM last one, image not getting uploaded to storage
    }

    public function edit(Post $post){
        $this->authorize('update', $post);
        //if(auth()->user()->can('view', $post)){

        //}
        return view('admin.posts.edit',['posts'=> $post]);
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        Session::flash('message', 'Post was deleted');
        return back();
    }

    public function update(Post $post){
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);
        if($file = request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];
        $this->authorize('update', $post);
        $post->update();
        //auth()->user()->posts()->save($post);
        Session::flash('post-created-message', 'Post with title '.$inputs['title'].' was updated');
        return redirect()->route('post.index');
    }
}

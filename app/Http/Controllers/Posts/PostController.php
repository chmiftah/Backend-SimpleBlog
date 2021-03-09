<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsCollection;
use App\Http\Resources\Posts\PostsResource;
use Illuminate\Support\Str;
use App\Models\Posts\Post;
use App\Models\Posts\Subject;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        //$posts=Post::with('user','subject')->latest()->paginate(10);
        $posts=Post::with('user','subject')->latest()->paginate(request('perPage'));
        return new PostsCollection($posts);
    }

    public function show(Subject $subject, Post $post){
        return new PostsResource($post);

    }

    public function lihat(Subject $subject, Post $post){
        return new PostsResource($post);
    }

    public function store(Request $request){

    //     auth()->loginUsingId(2);
    //     dd(auth()->user());
    // }


        request()->validate([
            'title'=>'required|min:6',
            'body'=>'required',
            'subject'=>'required',
        ]);

        Post::create([
            'title' => request('title'),
            'slug'=> Str::slug(request('title')),
            'body'=> request('body'),
            'subject_id'=>request('subject'),
            'user_id' => $request->user()->id,
        ]);
        return response()->json(['success'=>'The post was cretated']);
    }

    public function update (Post $post){
        $this->authorize('update', $post);
        request()->validate([
            'title'=>'required|min:6',
            'body'=>'required',
            'subject'=>'required',
        ]);

            $post->update([
                'title' => request('title'),
                'body'=> request('body'),
                'subject_id'=>request('subject'),

            ]);
            return (new PostsResource($post))->additional([
                'success'=>'The post was updated'
            ]);

    }

    public function destroy(Post $post){
        $post->delete();
    }
    public function search(Request $request)
    {
        //get the general information about the website
        $key = trim($request->get('q'));

        $post = Post::query()
            ->where('title', 'like', "%{$key}%")
            ->orWhere('body', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc')
            ->get();

            return $post;
    }


}

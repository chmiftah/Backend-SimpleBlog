<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;
class PostsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'=>collect($this->collection)->map(function($post){
             return[
                'id'=>$post->id,
                'slug'=>$post->slug,
                'title'=>$post->title,
                'body'=>Str::limit($post->body, 200),
                'author'=>$post->user->name,
                'user_id'=>$post->user_id,
                'subject'=>$post->subject,
                'published'=>$post->created_at->format("d F, Y"),
                'gravatar'=>$post->user->gravatar(),
             ];
            }),
            'hasMorePages' => $this->hasMorePages()
        ];
    }
}

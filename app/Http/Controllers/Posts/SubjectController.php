<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostsCollection;
use App\Models\Posts\Subject;
use Mockery\Matcher\Subset;

class SubjectController extends Controller
{
    //
    public function show(Subject $subject){
        $posts= $subject->posts()->latest()->paginate(request('perPage'));
        return new PostsCollection($posts);

    }

    public function index(Subject $subject){
        $subject= Subject::get(['id','name']);
        return ($subject);
    }
}

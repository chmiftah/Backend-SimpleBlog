<?php

namespace App\Http\Controllers\Auth;
use App\Http\Resources\Users\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        return $request->user();
    }

    public function index (Request $request)
    {
        //
        return new UserResource($request->user());
    }
}

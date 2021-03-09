<?php
use App\Http\Controllers\Posts\SubjectController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Auth\MeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

 Route::middleware('auth:sanctum')->group(function(){
     Route::get('/user', [MeController::class, 'index']);

     Route::prefix('posts')->namespace('Posts')->group(function(){
         Route::get('', [PostController::class, 'index'])->withoutMiddleware('auth:sanctum');
         Route::get('/search', [PostController::class, 'search']);
         Route::post('creates', [PostController::class, 'store'])->withoutMiddleware('auth:sanctum');
         Route::patch('{post:slug}/edit', [PostController::class, 'update']);
         Route::delete('{post:slug}/delete', [PostController::class, 'destroy']);
         Route::get('subject', [SubjectController::class,'index']);
         Route::get('{post:slug}', [PostController::class, 'show'])->withoutMiddleware('auth:sanctum');
         Route::get('subject/{subject:slug}',[SubjectController::class,'show'])->withoutMiddleware('auth:sanctum');
         Route::get('{subject:slug}/{post:slug}', [PostController::class,'lihat'])->withoutMiddleware('auth:sanctum');

     });
 });


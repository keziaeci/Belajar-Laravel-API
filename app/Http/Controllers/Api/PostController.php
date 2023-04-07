<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class PostController extends Controller
{
    public function index() {
        $post = Post::paginate(5);

        return new PostResource(true, 'berhasil',$post);
    }

    public function store(Request $request) {
        try {
            $validator = $request->validate([
            'name' => 'required',
            'category' => 'required'
            ]); 

            $validatedData = Post::create($validator);

            return new PostResource(true, 'Data berhasil dibuat', $validatedData);  //return berupa instance objek, yang mengembalikan data berupa json array
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Post $post)  {
        return new PostResource(true, 'Data ditemukan' , $post);
    }

    public function update(Request $request,Post $post) {
        try {
            $validator = $request->validate([
                'name' => 'required',
                'category' => 'required'
            ]);

            $post->update($validator);
            // $validatedData = Post::where('id',$post->id)->update($validator);
            return new PostResource(true,'data berhasil di-update',$post);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Post $post)   {
        $post->delete();
        return new PostResource(true,'data berhasil dihapus',null);
    }
}

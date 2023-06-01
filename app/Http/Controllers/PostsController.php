<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsdetailResource;
use App\Http\Resources\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\Stub\ReturnValueMap;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['store', 'update', 'destroy']);
        $this->middleware(['penjual'])->only('update', 'destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all();

        return PostsResource::collection($posts);
    }

    function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required'
        ]);

        if ($request->file) {

            $validated = $request->validate([
                'file' => 'mimes:jpg,jpeg,png|max:100000'
            ]);

            $filename = $this->generateRandomString();
            $extension = $request->file->extension();

            $path = Storage::putFileAs('image', $request->file, $filename . '.' . $extension);
            $request['image'] = $filename . '.' . $extension;
            $request['penjual'] = Auth::user()->id;
            $post = Posts::create($request->all());
        }
        
        $request['image'] = $filename.'.'.$extension;
        $request['penjual'] = Auth::user()->id;
        $post = Posts::create($request->all());

        $post = Posts::create([
            'judul' => $request->input('judul'),
            'image' => $request->input('image'),
            'deskripsi' => $request->input('deskripsi'),
            'penjual' => Auth::user()->id,
            'harga' => $request->input('harga')
        ]);

        return new PostsDetailResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $posts = Posts::findOrFail($id);
        return new PostsDetailResource($posts);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'string',
            'deskripsi' => 'string',
            'harga' => 'string'
        ]);

        $post = posts::findOrFail($id);
        $post->update($request->all());

        return new PostsdetailResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'your post has been deleted'
        ]);
    }
}

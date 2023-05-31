<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentsResource;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Author;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:sanctum']);
        $this->middleware(['pemilik-comment'])->only('update','destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:Posts,id',
            'comments_content' => 'required'
         ]);
     
         $request['user_id'] = Auth::user()->id;
     
         $comment = Comments::create($request->all());
     
         return new CommentsResource($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
        $request -> validate([
            'comments_content' => 'required'
        ]);

        $comment = Comments::findOrFail($id);
        $comment->update($request->all());

        return new CommentsResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();

        return response()->json(
            'your comment has been deleted'
        );
    }
}

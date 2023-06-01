<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Replies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:sanctum']);
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
        
         $request->validate([
            'post_id' => 'required | exists:posts,id',
            'comment_id' => 'required|exists:comments,id',
            'konfirmasi' => 'required'
        ]);

        $request['user_id'] = Auth::user()->id;

        $reply = Replies::create($request->all());
        return new ReplyResource($reply);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

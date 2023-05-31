<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsdetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'judul'=>$this->judul,
            'deskripsi'=>$this->deskripsi,
            'penjual'=>$this->seller['Username'],
            'harga'=>$this->harga,
            'created at'=> date_format($this->created_at,'Y/m/d H:i'),
            'comments' => CommentsResource::collection($this->comments),
            'reply'=> ReplyResource::collection($this->replies),
            'created at'=> date_format($this->created_at,'Y/m/d H:i'),
        ];

    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'judul'=>$this->judul,
            'image'=>$this->image,
            'deskripsi'=>$this->deskripsi,
            'penjual'=>$this->seller['Username'],
            'harga'=>$this->harga,
            'created at'=> date_format($this->created_at,'Y/m/d H:i'),
        ];
    }
}
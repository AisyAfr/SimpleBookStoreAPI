<?php

namespace App\Http\Resources;

use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'replier' => $this->user['Username'],
            'comment_id' => $this->comment_id,
            'konfirmasi' => $this->konfirmasi,
            'created_at' => date_format($this->created_at, 'Y/m/d H:i')
        ];
    }
}

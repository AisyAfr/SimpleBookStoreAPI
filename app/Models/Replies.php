<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Replies extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'post_id','comment_id','konfirmasi'
    ];

    /**
     * Get the user that owns the Replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comments::class, 'comment_id', 'id');
    }

    /**
     * Get the user that owns the Replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

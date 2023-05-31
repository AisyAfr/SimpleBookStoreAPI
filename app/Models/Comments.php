<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id', 'post_id', 'comments_content'
    ];

/**
 * Get the user that owns the Comments
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function commentator(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

/**
 * Get the user associated with the Comments
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function user(): HasOne
{
    return $this->replies(Comments::class, 'parent_id');
}


}

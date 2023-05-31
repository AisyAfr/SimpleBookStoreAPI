<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'judul',
        'image',
        'deskripsi',
        'penjual',
        'harga'
    ];



      /**
       * Get the replies associated with the Posts
       *
       * @return \Illuminate\Database\Eloquent\Relations\HasMany
       */
      public function replies(): HasMany
      {
          return $this->hasMany(Replies::class, 'post_id', 'id');
      }

     /**
      * Get all of the comments for the Posts
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function comments(): HasMany
     {
         return $this->hasMany(Comments::class, 'post_id', 'id');
     }

     /**
      * Get the reply associated with the Posts
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasOne
      */

      /**
       * Get the seller that owns the Posts
       *
       * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
       */
      public function seller(): BelongsTo
      {
          return $this->belongsTo(User::class, 'penjual', 'id');
      }


}

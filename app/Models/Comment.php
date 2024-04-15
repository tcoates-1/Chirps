<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'user_id',
        'chirp_id',
        'parent_id'
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function chirp(): BelongsTo
    {
        return $this->belongsTo(Chirp::class);
    }

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(Chirp::class, 'chirp_id');
    }

    public function childComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function hasGrandchildComment(): bool
    {
        return $this->childComments->contains(function ($comment) {
            return $comment->childComments()->exists();
        });
    }
}

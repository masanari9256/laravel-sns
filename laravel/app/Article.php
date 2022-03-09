<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo('App\User');
    }

    public function likes(): BelongsToMany {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    /**
     * ユーザーがいいね済かを判定する
     * @param User|null $user
     * @return bool
     */
    public function isLikedBy(?User $user): bool {
        return $user
            ? (bool) $this->likes->where('id', $user->id)->count()
            : false;
    }

    /**
     * 記事のいいね数をカウントするアクセサ
     * @return int
     */
    public function getCountLikesAttribute(): int {
        return $this->likes->count();
    }
}

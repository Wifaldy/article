<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function articleComments()
    {
        return $this->hasMany(ArticleComment::class, 'article_id', 'id');
    }

    public function articleHasArticleCategories()
    {
        return $this->hasMany(ArticleHasArticleCategory::class, 'article_id', 'id');
    }
}

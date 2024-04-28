<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleHasArticleCategory extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'article_id',
        'article_category_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id', 'id');
    }
}

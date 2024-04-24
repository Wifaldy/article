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
}

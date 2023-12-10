<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleTag extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'article_tags';

    protected $primaryKey = 'id';

    protected $fillable = [
        'article_id',
        'tag_id',
        'created_by',
        'deleted_at'
    ];
}

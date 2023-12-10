<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Article extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'articles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'image',
        'created_by',
        'deleted_at'
    ];

    public function view_tags()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function getCreatedAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->created_at));
    }

    public function getUpdatedAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->updated_at));
    }
}

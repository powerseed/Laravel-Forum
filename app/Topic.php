<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
      'title', 'body', 'category_id', 'excerpt', 'slug'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        if($order == 'last_replied')
        {
            return $query->orderBy('updated_at', 'desc');
        }
        else if ($order == 'last_posted')
        {
            return $query->orderBy('created_at', 'desc');
        }
        else
        {
            return $query->orderBy('updated_at', 'desc');
        }
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}

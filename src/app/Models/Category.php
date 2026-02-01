<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'content',
    ];

    //  リレーション
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

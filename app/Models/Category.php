<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'icon', 'user_id'];

    /**
     * User relation.
     * 
     * @return type
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

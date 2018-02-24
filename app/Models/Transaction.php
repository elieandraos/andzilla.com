<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['title', 'debit', 'amount', 'due_at', 'category_id', 'user_id'];
    public $timestamps = false;

    /**
     * User relation.
     * 
     * @return type
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Category relation.
     * 
     * @return type
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * Dude at mutator.
     * Manipulate the data format before persisting it in database.
     * 
     * @param type $value 
     * @return type
     */
    public function setDueAtAttribute($value)
    {
        $this->attributes['due_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Due at accessor.
     * 
     * @param type $value 
     * @return type
     */
    public function getDueAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }

    /**
     * Get the authenticated user transactions.
     * 
     * @param type $query 
     * @return type
     */
    public function scopeMine($query)
    {
        $authenticatedUser = Auth::user();
        return $query->where('user_id', '=', $authenticatedUser->id);
    }

}

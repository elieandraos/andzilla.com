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

     /**
     * Filter the transactions by categories.
     * 
     * @param type $query 
     * @return type
     */
    public function scopeByCategories($query, $categories = [])
    {
        if(!is_array($categories) || !count($categories))
            return $query;
       
        $categories = collect($categories)->map(function($item){
            return (int) $item;
        })->toArray();

        return $query->whereIn('category_id', $categories);
    }

    /**
     * Filter the transactions by date range
     * 
     * @param type $query 
     * @param type $dateString 
     * @return type
     */
    public function scopeByDaterange($query, $dateString = null)
    {
        if(!$dateString)
            return $query;

        $date = explode("-", $dateString);
        $startDate = Carbon::parse($date[0])->format('Y-m-d');
        $endDate   = Carbon::parse($date[1])->format('Y-m-d');
        
        return $query->where('due_at', '>=', $startDate)->where('due_at', '<=', $endDate);
    }
}

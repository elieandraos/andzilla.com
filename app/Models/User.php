<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /**
     * Categories relation.
     * 
     * @return type
     */
    public function categories()
    {
        return $this->hasMany(\App\Models\Category::class);
    }

    /**
     * Transactions relation.
     * 
     * @return type
     */
    public function transactions()
    {
        return $this->hasMany(\App\Models\Transaction::class);
    }

    /**
     * Assigns predefined categories for the user.
     * 
     * @return type
     */
    public function assignDefaultCategories()
    {
        $categories = [];

        $predefined = [
            ['name' => 'Hair & Beauty', 'icon' => 'fas fa-venus-mars'],
            ['name' => 'Bills', 'icon' => 'fas fa-dollar-sign'],
            ['name' => 'Car', 'icon' => 'fas fa-car'],
            ['name' => 'Clothes & Shoes', 'icon' => 'fas fa-shopping-bag'],
            ['name' => 'Eating Out', 'icon' => 'fas fa-utensils'],
            ['name' => 'Entertainment', 'icon' => 'fas fa-beer'],
            ['name' => 'Fitness & Sports', 'icon' => 'fas fa-shopping-bag'],
            ['name' => 'Gifts', 'icon' => 'fas fa-gift'],
            ['name' => 'Health Care', 'icon' => 'fas fa-heartbeat'],
            ['name' => 'Traveling', 'icon' => 'fas fa-plane'],
            ['name' => 'House', 'icon' => 'fas fa-home'],
            ['name' => 'Online subscriptions', 'icon' => 'fas fa-mouse-pointer'],
        ];

        foreach($predefined as $category){
            array_push($categories, new Category($category));
        }

        $this->categories()->saveMany($categories);
    }
}

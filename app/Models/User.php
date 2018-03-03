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
            ['name' => 'Hair & Beauty', 'icon' => 'fa fa-venus-mars'],
            ['name' => 'Monthly Bills', 'icon' => 'fa fa-dollar'],
            ['name' => 'Car', 'icon' => 'fa fa-car'],
            ['name' => 'Clothes & Shoes', 'icon' => 'fa fa-shopping-bag'],
            ['name' => 'Eating Out', 'icon' => 'fa fa-beer'],
            ['name' => 'Entertainment', 'icon' => 'fa fa-music'],
            ['name' => 'Fitness & Sports', 'icon' => 'fa fa-shopping-bag'],
            ['name' => 'Gifts', 'icon' => 'fa fa-gift'],
            ['name' => 'Health Care', 'icon' => 'fa fa-heartbeat'],
            ['name' => 'Traveling', 'icon' => 'fa fa-plane'],
            ['name' => 'House', 'icon' => 'fa fa-home'],
            ['name' => 'Online subscriptions', 'icon' => 'fa fa-mouse-pointer'],
            ['name' => 'Savings', 'icon' => 'fa fa-save'],
            ['name' => 'Wedding', 'icon' => 'fa fa-bell'],
            ['name' => 'Insurance Programs', 'icon' => 'fa lock'],
            ['name' => 'Dental Care', 'icon' => 'fa fa-cc-visa'],
            ['name' => 'Other', 'icon' => 'fa fa-paper-plane'],
        ];

        foreach($predefined as $category){
            array_push($categories, new Category($category));
        }

        $this->categories()->saveMany($categories);
    }
}

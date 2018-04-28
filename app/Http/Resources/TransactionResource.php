<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\Resource;

class TransactionResource extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'id'                =>  $this->id,
            'title'             =>  $this->title,
            'debit'             =>  $this->debit,
            'amount'            =>  number_format($this->amount, 2, '.', ',')." USD",
            'due_at'            =>  Carbon::parse($this->due_at)->format('d M, Y'),
            'category_name'     =>  $this->category->name,
            'category_icon'     =>  $this->category->icon,
            'edit_url'          =>  route('transactions.edit', $this->id),
            'add_url'           =>  route('transactions.create'),
        ];
    }
}

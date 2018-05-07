@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Dashboard</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <dashboard-income-widget 
                :total="'{{ $remaining }}'" 
                :currency="'USD'"
                :text="'current month remaining income'"
                :progress="{{ $progress }}"
            ></dashboard-income-widget>
       </div>

       <div class="col-lg-4">
            <dashboard-transactions-widget 
                :total="{{ $count }}" 
                :text="'current month total number of expenses transactions'"
            ></dashboard-transactions-widget>
       </div>

        <div class="col-lg-4">
            <dashboard-category-widget 
                :category="'{{ $highestCategoryName}}'"
                :text="'current month highest expenses category <small><b>{{$highestCategoryTotal}} USD</b></small>'"
                :icon = "'{{ $highestCategoryIcon }}'"
            ></dashboard-category-widget>
       </div>
    </div>
</div>
@endsection

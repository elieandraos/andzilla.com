@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">
                Transactions History
                <a class="btn btn-primary pull-right" href="{!! route('transactions.create') !!}">Add</a>
            </h1>
            <h2 class="subtitle">Below is your recent transactions list</h2>

            <div class="panel panel-default">
                <div class="panel-body">
                    @include('flash::message')
                    
                     {{-- <form id="transactions-filter">
                         {!! Form::select(
                            'category_id', 
                            $categories, 
                            null , 
                            [
                                'class' => 'selectpicker pull-right', 
                                'id' => 'category_id', 
                                'name' => 'categories[]',
                                'data-title' => 'Categories', 
                                'multiple' => 'multiple',
                                'data-selected-text-format' => 'count > 1'
                            ],
                            $icons_attributes
                        ) !!}

                        <div id="reportrange" class="pull-right" 
                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: auto">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp; Date range&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                    </form> --}}

                    <transactions></transactions>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

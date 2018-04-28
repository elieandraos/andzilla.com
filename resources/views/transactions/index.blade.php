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

                   {{--  @if(!$transactions->count())
                        <div class="empty-list">You have not added any transaction yet.</div>
                        <div class="empty-list">
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Create Transaction</a>
                        </div>
                    @else --}}
                    
                    {{--  {!! Form::select(
                        'category_id', 
                        $categories, 
                        null , 
                        ['class' => 'selectpicker pull-right', 'id' => 'category_id'],
                        $icons_attributes
                    ) !!}

                    <div id="reportrange" class="pull-right" 
                            style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: auto">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                        <span></span> <b class="caret"></b>
                    </div> --}}

                    <transactions></transactions>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

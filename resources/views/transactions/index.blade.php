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
                    <transactions></transactions>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

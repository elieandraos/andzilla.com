@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="title">Add Transaction</h1>
            <h2 class="subtitle">Fill in your transaction details</h2>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('transactions.store') }}">
                        {{ csrf_field() }}
                        @include('transactions.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
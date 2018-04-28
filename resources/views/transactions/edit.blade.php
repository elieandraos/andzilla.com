@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="title">Edit Transaction</h3>

            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::model($transaction, ['route' => ['transactions.update', $transaction->id], 'class' => 'form-horizontal']) !!}
                        @include('transactions.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

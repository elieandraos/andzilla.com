@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1 class="title">
                Transactions History
                <a class="btn btn-primary pull-right" href="{!! route('transactions.create') !!}">Add</a>
            </h1>
            <h2 class="subtitle">Below is your recent transactions list</h2>

            <div class="panel panel-default">
                <div class="panel-body">
                    @include('flash::message')

                    @if(!$transactions->count())
                        <div class="empty-list">You have not added any transaction yet.</div>
                        <div class="empty-list">
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Create Transaction</a>
                        </div>
                    @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="fixed-width-m">Amount</th>
                                <th class="fixed-width-m">Date</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class='fixed-width-m'>
                                        <span class="amount @if($transaction->debit) bg-success @else bg-danger @endif">
                                            <i class="fa  @if($transaction->debit) fa-arrow-up @else fa-arrow-down @endif"></i>
                                            {!! number_format($transaction->amount, 2, '.', ',') !!} USD
                                        </span>
                                    </td>
                                    <td class="fixed-width-m due-at">
                                        {!! $transaction->due_at !!}
                                    </td>
                                    <td class="transaction-title text-info">
                                        {!! $transaction->title !!}
                                        <p class="subtablecell">
                                            <i class="{!! $transaction->category->icon !!}"></i>
                                            {!! $transaction->category->name !!}
                                        </p>
                                    </td>
                                    <td class="row-actions">
                                        <ul>
                                            <li>
                                                <a class="btn btn-info btn-xs" href="{{ route('transactions.edit', $transaction->id) }}">Edit</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                            {!! $transactions->links() !!}

                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

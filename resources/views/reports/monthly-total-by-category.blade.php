@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">Finances Reports</h1>
            <h2 class="subtitle">Have an in-depth look on your finances</h2>

             <div class="btn-group flexing" role="group">
              <button type="button" class="btn btn-default">
                  <a href="{!! route('reports.current-month') !!}">Current Month</a>
                </button>
                <button type="button" class="btn btn-default">
                  <a href="{!! route('reports.monthly-total') !!}">Totals by months</a>
                </button>
                <button type="button" class="btn btn-default active">
                  <a href="{!! route('reports.monthly-total-by-category') !!}">Totals by months & ctageories</a>
                </button>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="subtitle chart-legend"><center>Total expenses by month and category</center></h2>
                    <graph-line :datasets="{{ $datasets}}" :labels="{{ $labels }}"></graph-line>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        {!! Form::text('title', old('title'), [ 'class' => 'form-control', 'id' => 'title'] ) !!}
        @if ($errors->has('title'))
            <span class="help-block">{{ $errors->first('title') }}</span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
    <label for="amount" class="col-md-4 control-label">Amount</label>

    <div class="col-md-6">
        {!! Form::text('amount', old('amount'), [ 'class' => 'form-control', 'id' => 'amount'] ) !!}
        @if ($errors->has('amount'))
            <span class="help-block">{{ $errors->first('amount') }}</span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('due_at') ? ' has-error' : '' }}">
    <label for="due_at" class="col-md-4 control-label">Due at</label>

    <div class="col-md-6">
        {!! Form::text('due_at', old('due_at'), [ 'class' => 'form-control datepicker', 'id' => 'due_at'] ) !!}
        @if ($errors->has('due_at'))
            <span class="help-block">{{ $errors->first('due_at') }}</span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
    <label for="debit" class="col-md-4 control-label">Type</label>

    <div class="col-md-6">
        <div class="pretty p-default p-curve p-toggle">
            <input type="checkbox" name="debit" value="1" id='debit' 
                @if(isset($transaction) && $transaction->debit == 1) checked  @endif />
               
            <div class="state p-success p-on">
                <label>Debit</label>
            </div>
             <div class="state p-danger p-off">
                <label>Credit </label>
            </div>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label for="category_id" class="col-md-4 control-label">Category</label>

    <div class="col-md-6">
        {!! Form::select(
            'category_id', 
            $categories, 
            null , 
            ['class' => 'selectpicker', 'id' => 'category_id'],
            $icons_attributes
        ) !!}
        @if ($errors->has('category_id'))
            <span class="help-block"> {{ $errors->first('category_id') }}</span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-8 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Submit
        </button>
    </div>
</div>
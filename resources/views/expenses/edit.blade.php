@extends('layouts.app')

@section('title', 'Edit '. $expense->name)

@section('content')


    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif

    {!! Form::open(['route' => ['expenses.update', $expense->id], 'method' => 'PUT']) !!}


    <div class="form-group">
        @if($expense->hasAcceptedPayments() && !Auth::user()->hasRole('Administrator'))
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', $expense->name, ['class'=>'form-control', 'readonly' => 'readonly']) !!}
        @else
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', $expense->name, ['class'=>'form-control']) !!}
        @endif
    </div>

    @if(Auth::user()->hasRole('Administrator'))
    <div class="form-group">
        {!! Form::label('user', 'User:') !!}
        @if($expense->hasAnyUser())
            {!! Form::select('user', $users, ['selected' => $expense->user->id]); !!}
        @else
            {!! Form::select('user', $users,null, ['placeholder' => 'Choose a user..']); !!}
        @endif
    @else
            {!! Form::hidden('user', Auth::user()->id); !!}
    @endif


    <div class="form-group">

    </div>
        {!! Form::label('payments', 'Current payments for this expense:') !!}
        <table class="table-bordered">
            <th>AMOUNT</th>
            <th>STATUS</th>
            @foreach($expense->payments as $payment)
            <tr>
                <td><a href="{{ route('payments.edit', $payment->id) }}"> {{$payment->amount}} $</a></td>
                <td>{{ $payment->showStatus() }}</td>
            </tr>
            @endforeach
            <tr><td colspan="2"> </td><td>SUM:</td></tr>
            <tr>
                <td colspan="2"> LACKING WITHOUT PENDING PAYMENTS:</td>
                <td>{{ ($expense->amount - $expense->sumPaymentsByStatus('0')) }} $</td>
            </tr>
            <tr>
                <td colspan="2"> LACKING OVERALL:</td>
                <td>{{ ($expense->amount - $expense->sumPaymentsByStatus('1'))}} $ </td>
            </tr>
        </table>
    <div>

    </div>

        <div class="form-group">
            @if($expense->hasAcceptedPayments() && !Auth::user()->hasRole('Administrator'))
                {!! Form::label('amount', 'Amount to pay:') !!}
                {!! Form::text('amount', $expense->amount, ['class'=>'form-control', 'readonly' => 'readonly']) !!}
            @else
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('amount', $expense->amount, ['class'=>'form-control']) !!}
            @endif
        </div>


    <div class="form-group">
        {!! Form::submit('Save changes', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
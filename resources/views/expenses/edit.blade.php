@extends('layouts.app')

@section('title', 'Edit'. $expense->name)

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
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $expense->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('user', 'User:') !!}
        @if($expense->hasAnyUser())
            {!! Form::select('user', $users, ['selected' => $expense->user->id]); !!}
        @else
            {!! Form::select('user', $users,null, ['placeholder' => 'Choose a user..']); !!}
        @endif

    <div class="form-group">

    </div>
        {!! Form::label('payments', 'Current payments for this expense:') !!}
        <table class="table-bordered">
            <th>AMOUNT</th>
            <th>STATUS</th>
            @foreach($expense->payments as $payment)
            <tr>
                <td><a href="{{ route('payments.edit', $payment->id) }}"> {{$payment->readAmount()}} $</a></td>
                <td>{{ $payment->showStatus() }}</td>
            </tr>
            @endforeach
            <tr><td> </td><td></td><td>SUM:</td></tr>
            <tr>
                <td></td>
                <td> LACKING WITHOUT PENDING PAYMENTS:</td>
                <td>{{ ($expense->amount - $expense->sumPaymentsByStatus('0'))/100 }} $</td>
            </tr>
            <tr>
                <td></td>
                <td> LACKING OVERALL:</td>
                <td>{{ ($expense->amount - $expense->sumPaymentsByStatus('1'))/100}} $ </td>
            </tr>
        </table>
    <div>

    </div>

    <div class="form-group">
        {!! Form::label('amount', 'Amount to pay:') !!}
        {!! Form::text('amount', $expense->readAmount(), ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save changes', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
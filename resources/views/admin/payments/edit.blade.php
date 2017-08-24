@extends('layouts.app')

@section('title', 'Edit payment')

@section('content')


    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif

    {!! Form::open(['route' => ['admin.payments.update', $payment->id], 'method' => 'PUT']) !!}

    <div class="form-group">
        {!! Form::label('expense', 'Expense:') !!}
        {!! Form::select('expense', $expenses, ['selected' => $payment->expense->id]); !!}
    </div>

    <div class="form-group">
        {!! Form::label('amount', 'Amount:') !!}
        {!! Form::text('amount', $payment->readAmount(), ['class'=>'form-control']) !!}
    </div>

    <div>
        {!! Form::label('status', 'Status:') !!}
        <table class="table-bordered">
            <th>REJECTED</th>
            <th>PENDING</th>
            <th>ACCEPTED</th>
            <tr>
                <td>{{ Form::radio('status', -1, $payment->status == -1) }}</td>
                <td>{{ Form::radio('status', 0, $payment->status == 0) }}</td>
                <td>{{ Form::radio('status', 1, $payment->status == 1) }}</td>
            </tr>
        </table>
    </div>

    <div class="form-group">
        {!! Form::submit('Save changes', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
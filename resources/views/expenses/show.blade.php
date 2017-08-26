@extends('layouts.app')

@section('title', 'Show '. $expense->name)

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
        {!! Form::text('name', $expense->name, ['class'=>'form-control', 'readonly' => 'readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('amount', 'Amount:') !!}
        {!! Form::text('amount', $expense->amount , ['class'=>'form-control', 'readonly' => 'readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('created', 'Created:') !!}
        {!! Form::text('created_at', $expense->created_at, ['class'=>'form-control', 'readonly' => 'readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('updated', 'Updated:') !!}
        {!! Form::text('updated_at', $expense->updated_at, ['class'=>'form-control', 'readonly' => 'readonly']) !!}
    </div>
    {!! Form::hidden('user', Auth::user()->id) !!}
    <div class="form-group">
        {!! Form::submit('Save to my expenses', ['class'=>'btn btn-success']) !!}
    </div>

    {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}

    {!! Form::close() !!}

@endsection
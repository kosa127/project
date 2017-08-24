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

    {!! Form::open(['route' => ['admin.expenses.update', $expense->id], 'method' => 'PUT']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $expense->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('user', 'User:') !!}
        @if($expense->hasAnyUsers())
            {!! Form::select('user', $users, ['selected' => $expense->user->id]); !!}
        @else
            {!! Form::select('user', $users,null, ['placeholder' => 'Choose a user..']); !!}
        @endif

    </div>

    <div class="form-group">
        {!! Form::label('amount', 'Amount:') !!}
        {!! Form::text('amount', $expense->readAmount(), ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save changes', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
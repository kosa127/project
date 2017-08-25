@extends('layouts.app')

@section('title', 'Create expense')

@section('content')


    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif

    {!! Form::open(['route' => 'expenses.store']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    @if(Auth::user()->hasRole('Administrator'))
    <div class="form-group">
        {!! Form::label('user', 'User:') !!}
        {!! Form::select('user', $users, null, ['placeholder' => 'Pick a user...']); !!}

    </div>
    @endif

    <div class="form-group">
        {!! Form::label('amount', 'Amount:') !!}
        {!! Form::text('amount', null, ['class'=>'form-control', 'placeholder' => 'e.g 1056,50']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
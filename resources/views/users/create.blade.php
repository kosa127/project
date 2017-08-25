@extends('layouts.app')

@section('title', 'Create user')

@section('content')


    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif

    {!! Form::open(['route' => 'users.store']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::text('password', null, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('roles', 'Roles:') !!}
        <p>{!!Form::checkbox('Administrator', 'Administrator') !!} Administrator</p>
        <p>{!!Form::checkbox('User', 'User') !!} User</p>
    </div>

    <div class="form-group">
        {!! Form::submit('Create', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
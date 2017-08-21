@extends('layouts.app')

@section('title', 'Edit '. $user->name )

@section('content')


    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif

    {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', $user->email, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::text('password', $user->password, ['class'=>'form-control']) !!}
        <p class="small help-block">That is user's hashed password, no need to being worried :) Feel free to change it.</p>

    </div>

    <div class="form-group">

        {!! Form::label('roles', 'Roles:') !!}
        @foreach(\App\Role::all() as $role)
            @if($user->hasRole($role->name))
                <p>{!!Form::checkbox($role->name, $role->name, true) !!} {{ $role->name }}</p>
            @else
                <p>{!!Form::checkbox($role->name, $role->name, false) !!} {{ $role->name }}</p>
            @endif
        @endforeach
    </div>

    <div class="form-group">
        {!! Form::submit('Save changes', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
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

    {!! Form::open(['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) !!}

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
        <p class="small help-block">This is user's hashed password, no need to be worried :) Feel free to change it.</p>

    </div>

    <div class="form-group">
        <table class="table table-bordered">
            <th class="warning">Name:</th>
            <th class="warning">Amount:</th>
            {!! Form::label(null, 'expenses') !!}
            @foreach($user->expenses as $expense)
            <tr>
                <td>{{$expense->name}}</td>
                <td>{{$expense->getPriceAttribute($expense->amount)}} $</td>
            </tr>
            @endforeach
            <tr>
                <td><b>Overall:</b></td>
                <td><b>{{ $user->getPriceAttribute($user->sumExpenses()) }} $</b></td>
            </tr>
        </table>
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
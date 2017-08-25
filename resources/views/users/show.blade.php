@extends('layouts.app')

@section('title', Auth::user()->name. ' profile')

@section('content')


    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    @endif
    {{Form::label('expenses', 'Your expenses:')}}
    @foreach(Auth::user()->expenses as $expense)
        <p>
        <table style="width:40%;" class="table table-bordered">
            <th style="background-color: #a6e1ec"><a href="{{ route('expenses.edit', $expense->id) }}">{{$expense->name}}</a></th>
            <th style="background-color: #a6e1ec">Priced: {{ $expense->amount }}$</th>
            <tr><td colspan="2">With payments:</td></tr>

            @foreach($expense->payments as $payment)
                <tr>
                    <td>{{$payment->amount}}$</td>
                    <td>{{$payment->showStatus()}}</td>
                </tr>
            @endforeach
        </table>
        </p>
    @endforeach


@endsection
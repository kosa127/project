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

            <th style="background-color: #a6e1ec; width:50%">
                @if(Auth::user()->hasRole('Administrator') || !$expense->hasAcceptedPayments())
                    <a href="{{ route('expenses.edit', $expense->id) }}">{{$expense->name}}</a>
                @else {{$expense->name}}
                @endif
            </th>

            <th style="background-color: #a6e1ec; width:50%">
                Priced: {{ $expense->amount }}$
                @if(Auth::user()->hasRole('Administrator') || !$expense->hasAcceptedPayments())
                {!! Form::model($expense, ['route' => ['expenses.destroy', $expense->id], 'method' => 'DELETE']) !!}
                <button class="btn btn-xs btn-danger" >Delete expense</button>
                {!! Form::close() !!}
                @endif
                <a class="btn btn-success btn-xs" href="{{ route('payments.create', $expense->id) }}">New payment </a>
            </th>

            <tr><td colspan="2">With payments:</td></tr>

            @foreach($expense->payments as $payment)
                @if($payment->status == 1)
                    <tr class="bg-success">
                @elseif($payment->status == 0)
                    <tr class="bg-info">
                @else($payment->status == -1)
                    <tr class="bg-danger">
                @endif

                    @if($payment->status == 1)
                        <td>{{$payment->amount}}$</td>
                        <td>{{$payment->showStatus()}}</td>
                        @else
                            <td>
                                <a href="{{route('payments.edit', $payment->id)}}">{{$payment->amount}}$</a>
                            </td>
                    <td>
                        {{$payment->showStatus()}}
                        {!! Form::model($payment, ['route' => ['payments.destroy', $payment->id], 'method' => 'DELETE']) !!}
                        <button class="btn btn-xs btn-danger" >Delete</button>
                        {!! Form::close() !!}
                    </td>
                    @endif
                </tr>
            @endforeach
        </table>
        </p>
    @endforeach



@endsection
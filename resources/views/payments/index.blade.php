@extends('layouts.app')

@section('title', "Payments managing")

@section('content')

    <table class="table table-bordered">
        <th>USER</th>
        <th>EXPENSE</th>
        <th>PAYMENT AMOUNT</th>
        <th>STATUS</th>
        <th> LAST MODIFICATION</th>
        <th>ACTIONS</th>
        @foreach($payments as $payment)
            @if($payment->status == -1) <tr class="bg-danger">
                @elseif($payment->status == 0) <tr class="bg-info">
                @elseif($payment->status == 1) <tr class="bg-success">
            @endif
                <td>
                    @if($payment->expense->hasAnyUser())
                    <a href=" {{route('users.edit', $payment->expense->user->id)}}">{{ $payment->expense->user->name }} </a>
                    @endif
                </td>
                <td>
                   <b> {{ $payment->expense->amount }} $</b>
                     <a href="{{ route('expenses.edit', $payment->expense->id) }}">{{ $payment->expense->name }} </a>
                </td>
                <td>
                    <b>{{ $payment->amount }} $ </b>
                </td>
                <td>
                    <b>{{ $payment->showStatus() }} </b>
                </td>
                <td>
                    {{ $payment->updated_at }}
                    <p> <b>{{ $payment->updated_at->diffForHumans() }}</b></p>
                </td>

                <td>
                    <div class="btn btn-group">
                        <a class="btn btn-info" href="{{ route('payments.edit', $payment->id) }}">Edit</a>
                        {!! Form::model($payment, ['route' => ['payments.destroy', $payment->id], 'method' => 'DELETE']) !!}
                        <button class="btn btn-danger" >Delete</button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    {{$payments->links()}}

@endsection
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

    {!! Form::open(['route' => ['payments.update', $payment->id], 'method' => 'PUT']) !!}

    {!! Form::hidden('expense', $payment->expense->id) !!}

    <div class="form-group">
        {!! Form::label('amount', 'Amount:') !!}
        {!! Form::text('amount', $payment->amount, ['class'=>'form-control']) !!}
    </div>
    @if(Auth::user()->hasRole('Administrator'))
    <div>
        {!! Form::label('status', 'Status:') !!}
        <table class="table-bordered" style="width:400px;">
            <th class="bg-danger">REJECTED</th>
            <th class="bg-info">PENDING</th>
            <th class="bg-success">ACCEPTED</th>
            <tr>
                @if($payment->status == -1) <td class="bg-danger"> @else <td> @endif
                        {{ Form::radio('status', -1, $payment->status == -1) }}</td>
                @if($payment->status == 0) <td class="bg-info"> @else <td> @endif
                    {{ Form::radio('status', 0, $payment->status == 0) }}</td>
                @if($payment->status == 1) <td class="bg-success"> @else <td> @endif
                    {{ Form::radio('status', 1, $payment->status == 1) }}</td>
            </tr>
        </table>
    </div>
        @else
        {{ Form::hidden('status', $payment->status) }}
    @endif

    <div class="form-group">
        {!! Form::submit('Save changes', ['class'=>'btn btn-primary']) !!}
        {!! link_to(URL::previous(), 'Previous', ['class'=>'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}

@endsection
<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::OrderBy('id', 'DESC')->paginate(10);

        return view('payments.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $expense_id = Expense::find($id)->id;

        return view('payments.create', ['expense_id' => $expense_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create($request->all());
        $payment->store($request);

        return redirect()->route('users.show', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);
        $expenses = Expense::pluck('name', 'id');

        return view('payments.edit', ['payment' => $payment, 'expenses' => $expenses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, $id)
    {
        Payment::find($id)->updateAll($request);

        if(Auth::user()->hasRole('Administrator'))
        {
            return redirect()->route('payments.index');
        }
        else return redirect()->route('users.show', Auth::user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::find($id)->removePayment();
        if(Auth::user()->hasRole('Administrator'))
        {
            return redirect()->route('payments.index');
        }
        else return redirect()->route('users.show', Auth::user()->id);

        /**
         * Remove the specified resource from storage.
         *
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */    }

//    public function attachExpense($id, $expense_id)
//    {
//        $expense = Expense::find($expense_id);
//
//        Payment::find($id)->attachExpense($expense);
//
//        return redirect()->route('users.show', Auth::user()->id);
//    }
}

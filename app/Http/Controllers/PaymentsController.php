<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\EditPaymentRequest;
use App\Payment;
use Illuminate\Http\Request;

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

        return view('admin.payments.index', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('admin.payments.edit', ['payment' => $payment, 'expenses' => $expenses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditPaymentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPaymentRequest $request, $id)
    {
        Payment::find($id)->updateAll($request);

        return redirect()->route('admin.payments.index');
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

        return redirect()->route('admin.payments.index');
    }
}

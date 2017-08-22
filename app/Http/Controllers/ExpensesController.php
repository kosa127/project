<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\CreateExpenseRequest;
use App\User;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::OrderBy('id', 'DESC')->paginate(10);

        return view('expenses.index', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');

        return view('expenses.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExpenseRequest $request)
    {

        $user = User::where('id', $request->user)->first();
        $expense = Expense::create($request->all());
        $expense->user()->associate($user->id);
        $expense->save();

//        $expense = Expense::create();
//        $expense->update(
//            ['name' => $request->name,
//                'amount' => $request->amount,
//                'user_id' => $request->user,
//            ]
//        );
//        $expense->save();

        return redirect()->route('expenses.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

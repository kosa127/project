<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\EditExpenseRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('Administrator'))
        {
            $expenses = Expense::OrderBy('id', 'updated_at')->paginate(10);
        }
        else $expenses = Expense::where('user_id', null)->orderBy('id', 'updated_at')->paginate(10);

        return view('admin.expenses.index', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');

        return view('admin.expenses.create', ['users' => $users]);
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
        $expense->writeAmount($request->amount);
        $expense->user()->associate($user->id);
        $expense->save();

        return redirect()->route('admin.expenses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::find($id);

        return view('admin.expenses.show', ['expense' => $expense]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        $users = User::pluck('name', 'id');

        return view('admin.expenses.edit', ['expense' => $expense, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditExpenseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditExpenseRequest $request, $id)
    {
        Expense::find($id)->updateAll($request);

        return redirect()->route('admin.expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->removeExpense();

        return redirect()->route('admin.expenses.index');
    }

}

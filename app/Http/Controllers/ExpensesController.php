<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles');
    }

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
     * @param  StoreExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all());
        $expense->store($request);

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
        $expense = Expense::find($id);
        $this->authorize('view', $expense);

        return view('expenses.show', ['expense' => $expense]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        $this->authorize('edit', $expense);
        $users = User::pluck('name', 'id');

        return view('expenses.edit', ['expense' => $expense, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateExpenseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, $id)
    {
        $expense = Expense::find($id);
        $this->authorize('update', $expense);
        $expense->updateAll($request);

        return redirect()->route('expenses.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::find($id);
        $this->authorize('delete', $expense);
        $expense->removeExpense();

        return redirect()->route('expenses.index');
    }

    public function attachUser($id)
    {
        Expense::find($id)->attachUser(Auth::user());

        return redirect()->route('expenses.index');
    }



}

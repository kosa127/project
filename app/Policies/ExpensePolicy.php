<?php

namespace App\Policies;

use App\User;
use App\Expense;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ExpensePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function view(User $user, Expense $expense)
    {
        if(Auth::user()->hasRole('Administrator') || $expense->user_id === null)
            return true;

        return $user->id === $expense->user_id;
    }


    /**
     * Determine whether the user can update the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function update(User $user, Expense $expense)
    {
        if(Auth::user()->hasRole('Administrator'))
            return true;

        return $user->id === $expense->user_id;
    }

    /**
     * Determine whether the user can delete the expense.
     *
     * @param  \App\User  $user
     * @param  \App\Expense  $expense
     * @return mixed
     */
    public function delete(User $user, Expense $expense)
    {
        if(Auth::user()->hasRole('Administrator'))
            return true;

        return $user->id === $expense->user_id;
    }

    public function edit(User $user, Expense $expense)
    {
        if(Auth::user()->hasRole('Administrator'))
            return true;

        return $user->id === $expense->user_id;
    }
}

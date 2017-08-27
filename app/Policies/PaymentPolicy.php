<?php

namespace App\Policies;

use App\User;
use App\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the payment.
     *
     * @param  \App\User  $user
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function update(User $user, Payment $payment)
    {
        if($user->hasRole('Administrator'))
            return true;

        foreach($user->expenses as $expense)
        {
            if($expense->id === $payment->expense_id)
                return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the payment.
     *
     * @param  \App\User  $user
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function delete(User $user, Payment $payment)
    {
        if($user->hasRole('Administrator'))
            return true;

        foreach($user->expenses as $expense)
        {
            if($expense->id === $payment->expense_id)
                return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the payment.
     *
     * @param  \App\User  $user
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function edit(User $user, Payment $payment)
    {
        if($user->hasRole('Administrator'))
            return true;

        foreach($user->expenses as $expense)
        {
            if($expense->id === $payment->expense_id)
                return true;
        }

        return false;
    }


}

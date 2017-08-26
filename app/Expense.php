<?php

namespace App;

use App\Http\Controllers\PaymentsController;
use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class Expense extends Model
{
    protected $fillable = [
        'name', 'user_id', 'amount',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function hasAnyUser()
    {
        if($this->user != null)
        {
            return true;
        }
        else return false;

    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function readAmount()
    {
        return $this->amount0;
    }

    public function writeAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function sumPayments()
    {
        $sum = 0;

        foreach($this->payments() as $payment)
        {
            $sum = $sum + $payment->amount;
        }

        return $sum;
    }

    public function updateAll(UpdateExpenseRequest $request)
    {

        $this->update([
            'name' => $request->name,
            'user_id' => $request->user,
            'amount' => $request->amount,

        ]);
        $this->save();
    }

    public function removeAllPayments()
    {
        $this->payments()->delete();
    }

    public function removeExpense()
    {
        if(Auth::user()->hasRole('Administrator'))
        {
            $this->removeAllPayments();
            $this->delete();
            return true;
        }
        else
        {
            foreach($this->payments as $payment)
            {
                if($payment->status == 1)
                {
                    return false;
                }
            }
            $this->removeAllPayments();
            $this->delete();
            return true;
        }


    }

    public function sumPaymentsByStatus($status)
    {
        $sum = 0;

        foreach($this->payments as $payment)
        {
                if($payment->status == $status)
                {
                    $sum = $sum + $payment->amount;
                }
        }

        return $sum;
    }

    public function attachUser($user)
    {
        $this->user()->associate($user);
        $this->save();
    }

    public function store(StoreExpenseRequest $request)
    {

        $this->amount = $request->amount;
        if($request->user != null)
        {
            $user = User::where('id', $request->user)->first();
            $this->user()->associate($user->id);
        }

        $this->save();
    }

    public function hasAcceptedPayments()
    {
        foreach($this->payments as $payment)
        {
            if($payment->status == 1)
            {
                return true;
            }
        }
        return false;
    }

}

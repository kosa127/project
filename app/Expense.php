<?php

namespace App;

use App\Http\Controllers\PaymentsController;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\UpdateExpenseRequest;

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
        return $this->amount/100;
    }

    public function writeAmount($amount)
    {
        $this->amount = $amount * 100;
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
            'amount' => $request->amount*100,

        ]);
        $this->save();
    }

    public function removeAllPayments()
    {
        $this->payments()->delete();
    }

    public function removeExpense()
    {
        $this->removeAllPayments();
        $this->delete();
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

}

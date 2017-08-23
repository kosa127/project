<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\EditExpenseRequest;

class Expense extends Model
{
    protected $fillable = [
        'name', 'user_id', 'amount',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
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

    public function updateAll(EditExpenseRequest $request)
    {


        $this->update([
            'name' => $request->name,
            'user_id' => $request->user,
            'amount' => $request->amount*100,

        ]);
        $this->save();
    }

    public function removeExpense()
    {
        $this->delete();
    }

}

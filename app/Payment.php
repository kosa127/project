<?php

namespace App;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount', 'status',
    ];

    public function expense()
    {
        return $this->belongsTo('App\Expense');
    }

    public function readAmount()
    {
        return $this->amount;
    }

    public function writeAmount($amount)
    {
        $this->amount = $amount;
    }

    public function showStatus()
    {
        $status = $this->status;

        if($status == -1)
        {
            return 'REJECTED';
        }
        elseif($status == 0)
        {
            return 'PENDING';
        }
        elseif($status == 1)
        {
            return 'ACCEPTED';
        }
        else return 'STATUS ERROR';
    }

    public function updateAll(UpdatePaymentRequest $request)
    {
        $this->update([
            'expense_id' => $request->expense,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);
        $this->save();
    }

    public function removePayment()
    {
        $this->delete();
    }

    public function store(StorePaymentRequest $request)
    {

        $this->amount = $request->amount;

        $expense = Expense::where('id', $request->expense_id)->first();
        $this->expense()->associate($expense);

        $this->save();
    }

    public function attachExpense($expense)
    {
        $this->expense()->associate($expense);
        $this->save();
    }


}

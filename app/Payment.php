<?php

namespace App;

use App\Http\Requests\EditPaymentRequest;
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
        return $this->amount/100;
    }

    public function writeAmount($amount)
    {
        $this->amount = $amount * 100;
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

    public function updateAll(EditPaymentRequest $request)
    {
        $this->update([
            'expense_id' => $request->expense,
            'amount' => $request->amount*100,
            'status' => $request->status,
        ]);
        $this->save();
    }

    public function removePayment()
    {
        $this->delete();
    }


}

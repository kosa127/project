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
        return $this->getAmount();
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

}

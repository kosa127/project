<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


}

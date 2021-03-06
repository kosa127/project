<?php

namespace App;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first())
        {
            return true;
        }

        return false;
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach($roles as $role)
            {
                if($this->hasRole($role))
                {
                    return true;
                }
            }
        }
        else
        {
            if($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }

    public function addRole($role)
    {
        $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        $this->roles()->detach($role);
    }

    public function removeAllRoles()
    {
        foreach(Role::all() as $role)
        {
            if($this->hasRole($role->name))
            {
                $this->roles()->detach($role);
            }
        }
    }

    public function hashPassword($password)
    {
        $this->password = bcrypt($password);
        $this->save();
    }

    public function updateRoles(StoreUserRequest $request)
    {
        foreach(Role::all() as $role)
        {
            if($request->has($role->name))
            {
                $this->addRole($role);
            }
        }
    }

    public function updateAll(UpdateUserRequest $request)
    {
        $this->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        $this->removeAllRoles();

        foreach(Role::all() as $role)
        {
            if($request->has($role->name))
            {
                $this->addRole($role);
            }
        }

    }

    public function removeUser()
    {
        $this->removeAllRoles();
        $this->removeAllExpenses();
        $this->delete();
    }

    public function sumExpenses()
    {
       $expenses = $this->expenses;
       $sum = 0;

       foreach($expenses as $expense)
       {
           $sum = $sum + $expense->amount;
       }

       return $sum;
    }

    public function removeAllExpenses()
    {
        $expenses = $this->expenses;

        foreach($expenses as $expense)
        {
            $expense->user()->dissociate();
            $expense->removeAllPayments();
            $expense->save();
        }
    }



}

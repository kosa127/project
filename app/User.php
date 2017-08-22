<?php

namespace App;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function updateRoles(CreateUserRequest $request)
    {
        foreach(Role::all() as $role)
        {
            if($request->has($role->name))
            {
                $this->addRole($role);
            }
        }
    }

    public function updateAll(EditUserRequest $request)
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
        $this->delete();
    }

}

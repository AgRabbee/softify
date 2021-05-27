<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;
use App\Models\Company;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider_name','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role','role_user','user_id', 'role_id');
    }

    public function companies()
    {
        return $this->belongsToMany('App\Models\Company','company_user','user_id')->withPivot('status');
    }


    public function company_users()
    {
        $allcompanyUsers = DB::table('users')
                        ->selectRaw('users.*,users.id as u_id,role_user.*')
                        ->join('role_user','users.id','role_user.user_id')
                        ->whereIn('role_user.role_id', [2, 3])
                        ->where('users.id','!=','1')
                        ->get();
        return $allcompanyUsers;
    }

    public function count_company_users()
    {
        //SELECT count(users.id) FROM users, role_user WHERE users.id = role_user.user_id AND role_user.role_id IN (2,3) AND users.id != 1
        $allcompanyUsers = DB::table('users')
                        ->selectRaw('count(users.id) as count_company_users')
                        ->join('role_user','users.id','role_user.user_id')
                        ->whereIn('role_user.role_id', [2, 3])
                        ->where('users.id','!=','1')
                        ->get();
        return $allcompanyUsers;
    }

    public function companyCount()
    {
        //SELECT count(users.id) FROM users, role_user WHERE users.id = role_user.user_id AND role_user.role_id IN (2,3) AND users.id != 1
        $allcompany = Company::where('company_status','1')->count();
        return $allcompany;
    }

    public function customers()
    {

        $allcustomers = DB::table('users')
						->selectRaw('users.*,users.id as u_id,role_user.*')
                        ->leftJoin('role_user','users.id','role_user.user_id')
                        ->whereNotIn('role_user.role_id', [1,2,3])
                        ->orWhere('users.user_status','=','0')
                        ->get();
        return $allcustomers;
    }
    public function tripsCount()
    {
        $tripsCount = DB::table('trips')
                        ->selectRaw('count(trips.id) as tripsCount')
                        ->get();
        return $tripsCount;
    }

}

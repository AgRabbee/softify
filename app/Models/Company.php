<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Company extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User','company_user','company_id')->withPivot('status');
    }
    public function transports()
    {
        return $this->belongsToMany('App\Models\Transport','transport_id','company_id')->withPivot('total_seats','registration_no');
    }

    public function allDrivers($company_id)
    {
        $driver_details = DB::table('users')
                            ->join('role_user','users.id','role_user.user_id')
                            ->join('company_user','users.id','company_user.user_id')
                            ->where('company_user.company_id',$company_id)
                            ->where('role_user.role_id','3')
                            ->get();
        return $driver_details;
    }

    public function userCount()
    {
        $company_id = Auth::user()->companies[0]->id;
        $details = DB::table('company_user')
                    ->selectRaw('COUNT(`id`) as userCount')
                    ->where('company_id',$company_id)
                    ->get();
        return $details;
    }

    public function transportCount()
    {
        $company_id = Auth::user()->companies[0]->id;
        $details = DB::table('company_transport')
                    ->selectRaw('COUNT(`id`) as transportCount')
                    ->where('company_id',$company_id)
                    ->get();
        return $details;
    }

    public function tripsCount()
    {
        $company_id = Auth::user()->companies[0]->id;
        $details = DB::table('trips')
                    ->selectRaw('COUNT(`id`) as tripsCount')
                    ->where('company_id',$company_id)
                    ->get();
        return $details;
    }

    public function reservationsCount()
    {
        $company_id = Auth::user()->companies[0]->id;

        $details = DB::table('reservations')
                    ->selectRaw('COUNT(reservations.id) as reservationsCount')
                    ->join('trips','reservations.trip_id','trips.id')
                    ->where('trips.company_id',$company_id)
                    ->where('reservations.seat_status','2')
                    ->get();
        return $details;
    }

}

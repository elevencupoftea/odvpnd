<?php

namespace App\Http\Controllers;

use App\Models\IpAddress;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileDashboardController extends Controller
{
    public function showDashboard(){
        $profiles = Profile::where('status', 1)
            ->orderByDesc('id')
            ->get();
        if($profiles){
            return view('pages.dashboard',['profiles'=>$profiles]);
        }
    }

    public function addProfile(Request $r){
        $free_local_id = IpAddress::where('active',0)
            ->orderByDesc('index')
            ->first();
        $local_id = $free_local_id->index;

        $free_local_id->active = 1;
        $free_local_id->save();


        $datetime = date('Y-m-d H:i:s', intval($r->input('days'))*24*60*60+time());

        $profile = new Profile();
        $profile->name = $r->input('name');
        $profile->alias_name = $r->input('alias_name');
        $profile->comment = $r->input('comment');
        $profile->local_id = $local_id;
        $profile->status = 99;
        $profile->days = $r->input('days');
        $profile->expired = $datetime;
        $profile->save();

        $created_profile = Profile::where('name', $r->input('name'))->first();
        while($created_profile->status !== 1){
            $created_profile->refresh();
        }
        return redirect("dashboard");
    }



}

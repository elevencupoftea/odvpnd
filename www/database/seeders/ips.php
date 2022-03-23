<?php

namespace Database\Seeders;

use App\Models\IpAddress;
use Illuminate\Database\Seeder;

class ips extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=100;$i<=250;$i++){
            $ip = new IpAddress();
            $ip->index=$i;
            $ip->active=0;
            $ip->save();
        }
    }
}

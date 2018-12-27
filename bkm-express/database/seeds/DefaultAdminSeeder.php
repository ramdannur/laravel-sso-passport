<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Profile;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{

            DB::beginTransaction();

            $modelUser = new User;
            $modelUser->name = 'Developer CyberLabs';
            $modelUser->email = 'cyberlabs.dev@gmail.com';
            $modelUser->password = bcrypt('developers');
            $modelUser->is_admin = 1;
            $modelUser->save();
            
            $modelProfile = new Profile;
            $modelProfile->user_id = $modelUser->id;
            $modelProfile->phone = '896123123'; 
            $modelProfile->address = 'Bandung';
            $modelProfile->save();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();
        
        }
    }
}

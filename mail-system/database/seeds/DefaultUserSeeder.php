<?php

use Illuminate\Database\Seeder;
use App\User;

class DefaultUserSeeder extends Seeder
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
            $modelUser->name = 'Dummy User';
            $modelUser->email = 'dummy@gmail.com';
            $modelUser->password = bcrypt('secret');
            $modelUser->save();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();
        
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
           'name' => 'teste',
            'email' => 'teste@email.com',
            'admin' => 1,
            'password' => bcrypt('password')
        ]);
        
        App\Profile::create([
           'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.jpg',
            'about' => 'Testador do teste Piloti'            
        ]);
    }
}

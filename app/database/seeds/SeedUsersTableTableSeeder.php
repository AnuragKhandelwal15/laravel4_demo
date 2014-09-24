<?php

class SeedUsersTableTableSeeder extends Seeder {

	public function run()
	{
            DB::table('users')->truncate();

            $users =[
                        [
                            'first_name' => 'Anurag',
                            'last_name' => 'Khandelwal',
                            'email' => 'anurag@gmail.com',
                            'password' => Hash::make('anurag1')
                        ],
                        [
                            'first_name' => 'Anshu',
                            'last_name' => 'Khandelwal',
                            'email' => 'anshu@gmail.com',
                            'password' => Hash::make('anshu1')
                        ],
                    ];

                    foreach($users as $user)
                    {
                        User::create($user);
                    }
	}

}
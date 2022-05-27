<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(4)->create();

        $user = User::find(1);
        $user->name = 'Yuanchin';
        $user->email = 'cs861229503@gmail.com';
        $user->avatar = 'https://bruce-fe-fb.web.app/image/avator.png';
        $user->save();
    }
}

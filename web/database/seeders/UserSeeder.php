<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "tanaka";
        $user->email = "test@gmail.com";
        $user->password = bcrypt("11111111");
        $user->save();
    }
}

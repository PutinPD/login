<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate user table
        User::truncate(); //se elimina para cuando se llame a este seeder no se repitan los usuarios de abajo

        DB::table('role_user')->truncate();

        //adjuntando los roles , tomando los roles y adjuntandolos a user
        $adminRole = Role::where('name','admin')->first();
        $authorRole = Role::where('name','author')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('admin')
        ]);

        $author = User::create([
            'name'=>'Author',
            'email'=>'author@author.com',
            'password'=>bcrypt('author')
        ]);

        $user = User::create([
            'name'=>'User',
            'email'=>'user@user.com',
            'password'=>bcrypt('user')
        ]);

        //uniendo roles con usuarios
        //roles() <- metodo creado en modelo User

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);

        factory(App\User::class,50)->create();
    }
}
<?php

use Illuminate\Database\Seeder;

use App\Model\Authentification\User as Model;
use App\Model\Authentification\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //user 1
        $model            = new Model();
        $role             = Role::where('name', 'User')->firstOrFail();
        $model->name      = 'User';
        $model->email     = 'user@user.user';
        $model->password  = Hash::make('sayauser');
        $model->active = true;
        $model->is_admin  = false;
        if ($model->save()) {
            $model->roles()->attach($role->id);
        }

        //User 2
        $model            = new Model();
        $role             = Role::where('name', 'Other')->firstOrFail();
        $model->name      = 'User 2';
        $model->email     = 'other@other.other';
        $model->password  = Hash::make('sayaother');
        $model->active = true;
        $model->is_admin  = false;
        if ($model->save()) {
            $model->roles()->attach($role->id);
        }

        //admin
        $model            = new Model();
        $role             = Role::where('name', 'Admin')->firstOrFail();
        $model->name      = 'Admin';
        $model->email     = 'admin@admin.admin';
        $model->password  = Hash::make('sayaadmin');
        $model->active = true;
        $model->is_admin  = true;
        if ($model->save()) {
            $model->roles()->attach($role->id);
        }

    }
}

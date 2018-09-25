<?php

use Illuminate\Database\Seeder;
use App\Model\Authentification\Role as Model;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Model();
        $model->name = 'Admin';
        $model->title = 'Admin';
        $model->save();

        $model = new Model();
        $model->name = 'User';
        $model->title = 'User';
        $model->save();

        $model = new Model();
        $model->name = 'Other';
        $model->title = 'Other';
        $model->save();
    }
}

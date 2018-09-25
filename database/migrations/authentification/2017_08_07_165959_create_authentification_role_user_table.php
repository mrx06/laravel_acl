<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthentificationRoleUserTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        if (!Schema::connection('authentification')->hasTable('role_user')) {
            Schema::connection('authentification')->create('role_user', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('role_id');
                $table->uuid('user_id');
                $table->timestamps();
            });
            DB::statement('ALTER TABLE ONLY authentification.role_user ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
        }
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        if (Schema::connection('authentification')->hasTable('role_user')) {
            Schema::connection('authentification')->drop('role_user');
        }
    }
}

<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthentificationUsersTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        if (!Schema::connection('authentification')->hasTable('users')) {
            Schema::connection('authentification')->create('users', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->boolean('active')->default(false);
                $table->boolean('is_admin')->default(false);
                $table->boolean('is_password_reseted')->default(false);
                $table->boolean('confirmed')->default(false);
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
            });
            DB::statement('ALTER TABLE ONLY authentification.users ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
        }
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        if (Schema::connection('authentification')->hasTable('users')) {
            Schema::connection('authentification')->drop('users');
        }
    }
}

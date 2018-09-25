<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthentificationRolesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        if (!Schema::connection('authentification')->hasTable('roles')) {
            Schema::connection('authentification')->create('roles', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('title')->nullable();
                $table->uuid('created_by')->nullable();
                $table->uuid('modified_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
            DB::statement('ALTER TABLE ONLY authentification.roles ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
        }
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        if (Schema::connection('authentification')->hasTable('roles')) {
            Schema::connection('authentification')->drop('roles');
        }
    }
}

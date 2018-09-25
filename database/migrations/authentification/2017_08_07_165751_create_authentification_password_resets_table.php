<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthentificationPasswordResetsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        if (!Schema::connection('authentification')->hasTable('password_resets')) {
            Schema::connection('authentification')->create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token')->index();
                $table->timestamp('created_at')->nullable();
            });
        }
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        if (Schema::connection('authentification')->hasTable('password_resets')) {
            Schema::connection('authentification')->drop('password_resets');
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPostsAndUsersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('handle');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->text('tagline');
            $table->text('footer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('handle');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('tagline');
            $table->dropColumn('footer');
        });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToAllModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->softDeletes();
        });
        Schema::table('roles', function($table) {
            $table->softDeletes();
        });
        Schema::table('languages', function($table) {
            $table->softDeletes();
        });
        Schema::table('words', function($table) {
            $table->softDeletes();
        });
        Schema::table('descriptions', function($table) {
            $table->softDeletes();
        });
        Schema::table('definitions', function($table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('roles', function($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('languages', function($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('words', function($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('descriptions', function($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('definitions', function($table) {
            $table->dropColumn('deleted_at');
        });
    }
}

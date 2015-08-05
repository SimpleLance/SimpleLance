<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->after('password');
            $table->text('address2')->after('password');
            $table->text('city')->after('password');
            $table->text('state')->after('password');
            $table->text('post_code')->after('password');
            $table->text('country')->after('password');
            $table->text('phone')->after('password');
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
            $table->dropColumn('address');
            $table->dropColumn('address2');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('post_code');
            $table->dropColumn('country');
            $table->dropColumn('phone');
        });
    }
}

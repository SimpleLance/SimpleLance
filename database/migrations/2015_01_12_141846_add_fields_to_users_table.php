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
            $table->text('address')->after('last_name');
            $table->text('address2')->after('last_name');
            $table->text('city')->after('last_name');
            $table->text('state')->after('last_name');
            $table->text('post_code')->after('last_name');
            $table->text('country')->after('last_name');
            $table->text('phone')->after('last_name');
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

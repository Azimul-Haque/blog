<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('blood_group');
            $table->integer('blood_donate')->unsigned();
            $table->dateTime('last_donated')->nullable();
            $table->string('permanent_district');
            $table->string('permanent_upazila');
            $table->string('permanent_address_privacy');
            $table->string('present_district');
            $table->string('present_upazila');
            $table->string('present_address_privacy');
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
             $table->dropColumn('blood_group');
             $table->dropColumn('blood_donate');
             $table->dropColumn('last_donated');
             $table->dropColumn('permanent_district');
             $table->dropColumn('permanent_upazila');
             $table->dropColumn('permanent_address_privacy');
             $table->dropColumn('present_district');
             $table->dropColumn('present_upazila');
             $table->dropColumn('present_address_privacy');
        });
    }
}

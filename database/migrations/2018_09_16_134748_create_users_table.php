<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->boolean('admin')->default(false);
            $table->char('gender')->nullable();
            $table->integer('report_id')->unsigned();
            $table->foreign('report_id')->references('id')->on('reports');
            $table->integer('organization_id')->unsigned();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->char('complete_survey')->default('нет');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContacMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactTable',function (Blueprint $table){
            $id = $table->bigIncrements('id');
            $name= $table->string('name');
            $phone = $table->string('phone');
            $emaile = $table->string('Emaile');
            $messege = $table->string('msg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

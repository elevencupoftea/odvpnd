<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("alias_name")->nullable();
            $table->string("comment")->nullable();
            $table->integer("local_id");
            $table->integer("status")->default(99);
            $table->integer("days")->default(0);
            $table->integer("days_left")->default(0);
            $table->dateTime("expired");
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
        Schema::dropIfExists('profiles');
    }
};

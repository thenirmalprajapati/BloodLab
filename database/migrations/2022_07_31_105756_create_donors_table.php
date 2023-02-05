<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorsTable extends Migration
{ 
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->nullable();
            $table->integer('blood_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('age')->nullable();
            $table->string('religion', 40)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('phone',40)->nullable();
            $table->string('profession', 80)->nullable();
            $table->text('details');
            $table->string('country', 80)->nullable();
            $table->string('address')->nullable();
            $table->integer('total_donate')->default(0);
            $table->tinyInteger('gender')->nullable()->comment('Male : 1, Female : 2')->default(0);
            $table->tinyInteger('status')->default(0)->comment('Pending : 0, Approved : 1, Banned : 2');
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
        Schema::dropIfExists('donors');
    }
}

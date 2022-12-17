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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('photo');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->decimal('salary', 6, 3);
            $table->string('date_of_employment');
            $table->integer('admin_created_id');
            $table->integer('admin_updated_id')->nullable();
            $table->unsignedBigInteger("position_id");
            $table->foreign('position_id')->references('id')->on('positions');
            $table->integer("employee_id")->nullable();
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
        Schema::dropIfExists('employees');
    }
};

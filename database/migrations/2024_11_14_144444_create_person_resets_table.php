<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonResetsTable extends Migration
{
    public function up()
    {
        Schema::create('person_resets', function (Blueprint $table) {
            $table->id();
            $table->string('check_number', 20);
            $table->string('image');
            $table->string('simu', 10)->unique()->nullable();
            $table->timestamp('registered_date')->useCurrent();
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('person_resets');
    }
}


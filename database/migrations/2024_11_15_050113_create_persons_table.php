<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    public function up()
    {
        Schema::create('person_news', function (Blueprint $table) {
            $table->id();
            $table->string('check_number')->unique();
            $table->string('image')->nullable();
            $table->string('simu');
            // Use enum type for status
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamp('registered_date')->default(now());
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('persons');
    }
}

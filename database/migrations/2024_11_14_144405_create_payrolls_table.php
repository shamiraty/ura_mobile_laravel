<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->string('checkNumber', 100)->primary();
            $table->string('department', 100)->nullable();
            $table->string('fname', 100)->nullable();
            $table->string('mname', 100)->nullable();
            $table->string('lname', 100)->nullable();
            $table->string('bankName', 100)->nullable();
            $table->string('accountNumber', 100)->nullable();
            $table->decimal('grossAmount', 20, 2)->nullable();
            $table->decimal('basicSalary', 20, 2)->nullable();
            $table->decimal('netAmount', 20, 2)->nullable();
            $table->decimal('allowance', 20, 2)->nullable();            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}


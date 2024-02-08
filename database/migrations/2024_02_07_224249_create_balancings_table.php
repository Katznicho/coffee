<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balancings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('coffee_type_id')->constrained(); 
            $table->string("mc");
            $table->integer("initial_kgs");
            $table->integer("cuttings");
            $table->integer("final_kgs");
            $table->string("price");
            $table->string("amount");
            $table->string("milling")->nullable();
            $table->string("bag")->nullable();
            $table->integer("box")->nullable();
            $table->string("labour")->nullable();
            $table->string("sun_dry")->nullable();
            $table->string("transport")->nullable();
            $table->string("advance")->nullable();
            $table->string("balance");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balancings');
    }
};

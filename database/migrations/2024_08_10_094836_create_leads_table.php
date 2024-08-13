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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('job_type');
            $table->string('services')->nullable();
            $table->string('budget');
            $table->decimal('price', 10, 2)->nullable();
            $table->text('description');
            $table->date('deadline');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('company');
            $table->string('website_url')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('max_sold');
            $table->decimal('budget_price_1', 10, 2);
            $table->decimal('budget_price_2', 10, 2);
            $table->decimal('budget_price_3', 10, 2);
            $table->decimal('budget_price_4', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

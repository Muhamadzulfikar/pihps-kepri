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
        Schema::create('inflation_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('commodity_uuid')->references('uuid')->on('commodities')->cascadeOnDelete();
            $table->double('inflation');
            $table->double('percentage');
            $table->double('average');
            $table->date('start_date');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inflation_histories');
    }
};

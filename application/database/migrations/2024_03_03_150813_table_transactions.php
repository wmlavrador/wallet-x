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
        Schema::create('transactions', function(Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('wallets_id_sender')->references('id')->on('wallets');
            $table->foreignId('wallets_id_receiver')->references('id')->on('wallets');
            $table->decimal('value');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

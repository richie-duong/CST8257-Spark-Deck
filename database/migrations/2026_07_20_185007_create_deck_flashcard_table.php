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
    Schema::create('deck_flashcard', function (Blueprint $table) {

        $table->foreignId('deck_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('flashcard_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->unique(['deck_id', 'flashcard_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deck_flashcard');
    }
};

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
        Schema::table('competitions', function (Blueprint $table) {
            // Add foreign key constraints after all tables are created
            $table->foreign('current_question_id')->references('id')->on('questions')->onDelete('set null');
            $table->foreign('first_buzz_participant_id')->references('id')->on('participants')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropForeign(['current_question_id']);
            $table->dropForeign(['first_buzz_participant_id']);
        });
    }
};

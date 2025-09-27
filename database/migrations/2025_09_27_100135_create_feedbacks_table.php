<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->longText('message');
            $table->enum('type', ['bug', 'feature_request', 'improvement', 'compliment', 'complaint', 'other'])->default('other');
            $table->enum('status', ['new', 'in_progress', 'resolved', 'closed'])->default('new');
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteer_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('task_name', 100);
            $table->text('description')->nullable();
            $table->unsignedInteger('slots_available');
            $table->timestamps();
        });

        Schema::create('volunteer_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('task_id')->constrained('volunteer_tasks')->cascadeOnDelete();
            $table->string('availability', 100)->nullable();
            $table->timestamp('assigned_at')->useCurrent();

            $table->unique(['user_id', 'task_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_assignments');
        Schema::dropIfExists('volunteer_tasks');
    }
};

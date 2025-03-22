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
        Schema::create('associates', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->mediumText('notes')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')
                ->constrained();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associates');
    }
};

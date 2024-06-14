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
        Schema::create('loans', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignId('user_id')
                ->constrained();
            $table->foreignUlid('customer_id')
                ->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('method', ['simple', 'fixed', 'compound', 'annual'])
                ->default('simple');
            $table->float('interest');
            $table->decimal('initial_capital', total: 8, places: 2);
            $table->decimal('capital', total: 8, places: 2);
            $table->decimal('quota', total: 8, places: 2);
            $table->enum('frequency', ['monthly', 'single', 'open'])
                ->default('monthly');
            $table->smallInteger('day_of_month');
            $table->smallInteger('payments');
            $table->smallInteger('payments_pending')
                ->default(0);
            $table->smallInteger('payments_received')
                ->default(0);
            $table->enum('status', ['active', 'paused', 'completed'])
                ->default('active');
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};

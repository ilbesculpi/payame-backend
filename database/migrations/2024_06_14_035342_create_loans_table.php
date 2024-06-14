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
            $table->float('interest_rate');
            $table->decimal('initial_capital', total: 8, places: 2);
            $table->decimal('capital', total: 8, places: 2);
            $table->decimal('quota', total: 8, places: 2);
            $table->enum('frequency', ['monthly', 'single', 'open'])
                ->default('monthly');
            $table->string('pay_day')
                ->nullable();
            $table->smallInteger('payments')
                ->nullable();
            $table->smallInteger('payments_remaining')
                ->nullable()
                ->default(0);
            $table->smallInteger('payments_received')
                ->nullable()
                ->default(0);
            $table->smallInteger('payments_overdue')
                ->nullable()
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

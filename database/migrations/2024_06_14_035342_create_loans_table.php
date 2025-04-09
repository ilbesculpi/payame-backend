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
            $table->decimal('initial_amount', total: 8, places: 2);
            $table->decimal('current_amount', total: 8, places: 2);
            $table->enum('interest_method', ['simple', 'fixed', 'compound', 'annual'])
                ->default('simple');
            $table->float('interest_rate');
            $table->decimal('payment_amount', total: 8, places: 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('pay_day')
                ->nullable();
            $table->smallInteger('terms');
            $table->enum('terms_unit', ['days', 'weeks', 'months', 'years'])
                ->default('months');
            $table->smallInteger('payments_remaining')
                ->default(0);
            $table->smallInteger('payments_received')
                ->default(0);
            $table->smallInteger('payments_overdue')
                ->default(0);
            $table->enum('status', ['active', 'paused', 'completed'])
                ->default('active');
            $table->mediumText('notes')
                ->nullable();
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

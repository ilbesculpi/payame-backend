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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('loan_id')->constrained();
            $table->dateTime('date');
            $table->decimal('capital_paid', total: 8, places: 2)
                ->default(0);
            $table->decimal('interest_paid', total: 8, places: 2)
                ->default(0);
            $table->decimal('delay_paid', total: 8, places: 2)
                ->default(0);
            $table->decimal('total', total: 8, places: 2)
                ->default(0);
            $table->enum('payment_method', ['cash', 'wire']);
            $table->mediumText('notes')
                ->nullable();
            $table->enum('status', ['pending', 'received']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

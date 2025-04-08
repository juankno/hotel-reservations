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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('room_id')->constrained('rooms');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('number_of_guests')->default(1);
            $table->decimal('total_price', 8, 2)->default(0.00);
            $table->foreignId('reservation_status_id')->constrained('reservation_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('calls', function (Blueprint $table) {
        $table->id();
        $table->string('phone');
        $table->integer('duration');
    
        $table->decimal('price', 8, 2)->nullable();
        $table->timestamp('call_time');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
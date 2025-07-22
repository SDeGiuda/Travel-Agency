<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('airline_cities', function (Blueprint $table) {
            $table->foreignId('airline_id')->constrained('airlines');
            $table->foreignId('city_id')->constrained('cities');
            $table->primary(['airline_id', 'city_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airline_allowed_cities');
    }
};

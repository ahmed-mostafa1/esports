<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();          // e.g. 'home.h1.tournament'
            $table->json('value')->nullable();        // {"en": "...", "ar": "..."} OR image URL per locale
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('contents');
    }
};
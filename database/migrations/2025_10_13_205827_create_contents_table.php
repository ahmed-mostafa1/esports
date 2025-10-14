<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();          // e.g. home.hero.title
            $table->string('type')->default('text');  // text | image
            $table->string('group')->nullable();      // e.g. home, about, partners
            $table->json('value')->nullable();        // text: {"en":"...","ar":"..."}; image: {"path":"home.hero.png"}
            $table->timestamps();

            // Optional helpers if you like:
            $table->index('group');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};

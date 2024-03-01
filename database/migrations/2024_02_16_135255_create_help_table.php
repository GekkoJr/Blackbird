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
        Schema::create('help', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean("isDirectory");
            $table->unsignedBigInteger("parent")->nullable()->index();
            $table->timestamps();
            $table->foreign("parent")->references("id")->on("help")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help');
    }
};

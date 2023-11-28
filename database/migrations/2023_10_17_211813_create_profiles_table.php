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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('description') -> nullable();
            $table->string('abilities') -> nullable();
            $table->integer('phone_number') -> nullable();
            $table->string('province') -> nullable();
            $table->timestamps();
            
            $table -> foreignId('contacts_id') -> nullable() -> constrained(); 
            $table -> foreignId('ratings_id') -> nullable() -> constrained();
            $table -> foreignId('users_id') -> constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

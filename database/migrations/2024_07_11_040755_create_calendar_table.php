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
        Schema::create('calendar', function (Blueprint $table) {
            $table->id( 'id_calendar' );
            $table->integer( 'day' );
            $table->integer( 'month' );
            $table->integer( 'year' );
            $table->string( 'name' );
            $table->string( 'color' );
            $table->boolean( 'recurrent' )->default( false );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar');
    }
};

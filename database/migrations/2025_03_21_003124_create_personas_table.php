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
        Schema::create('personas', function (Blueprint $table) {
            $table->id(); // id (BI, AI, PK, US)
            $table->string('nombres', 50); // nombre (VARCHAR 100)
            $table->string('apellidos', 50)->nullable(); // apellido (VARCHAR 100)
            $table->date('fecha_nacimiento')->nullable(); // fecha_nacimiento (VARCHAR 100)
            $table->boolean('estado')->default(true); // estado (BOOLEAN)
            $table->integer('ci')->nullable(); // ci (INT)

            $table->bigInteger('user_id')->unsigned()->nullable(); // user_id (INT)
            $table->foreign('user_id')->references('id')->on('users'); // user_id (FK)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};

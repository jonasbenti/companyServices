<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('company_id');
            $table->string('cpf', 11)->unique();
            $table->string('name', 220);
            $table->foreignId('company_id')
                ->constrained('companies')
                ->onDelete('cascade');
            // $table->foreign('company_id')
            //     ->references('id')
            //     ->on('companies')
            //     ->constrained()
            //     ->onDelete('cascade');
            // $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

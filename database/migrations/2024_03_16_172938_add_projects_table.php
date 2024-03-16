<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price', total: 10, places: 2);
            $table->boolean('jobs_done')->default(false);
            $table->date('started');
            $table->date('finished')->nullable();
            $table->bigInteger('leader');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('projects');
    }
};

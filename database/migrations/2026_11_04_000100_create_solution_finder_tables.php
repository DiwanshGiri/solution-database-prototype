<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id(); $table->string('name'); $table->text('description')->nullable(); $table->timestamps();
        });
        Schema::create('solutions', function (Blueprint $table) {
            $table->id(); $table->string('name'); $table->text('description')->nullable(); $table->timestamps();
        });
        Schema::create('offers', function (Blueprint $table) {
            $table->id(); $table->string('name'); $table->enum('type', ['product', 'service', 'approach'])->default('product');
            $table->text('description')->nullable(); $table->string('url')->nullable(); $table->timestamps();
        });
        Schema::create('tags', function (Blueprint $table) {
            $table->id(); $table->string('name')->unique(); $table->timestamps();
        });
        Schema::create('problem_solution', function (Blueprint $table) {
            $table->foreignId('problem_id')->constrained()->cascadeOnDelete();
            $table->foreignId('solution_id')->constrained()->cascadeOnDelete();
            $table->primary(['problem_id', 'solution_id']);
        });
        Schema::create('offer_solution', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('solution_id')->constrained()->cascadeOnDelete();
            $table->primary(['offer_id', 'solution_id']);
        });
        Schema::create('offer_tag', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['offer_id', 'tag_id']);
        });
        Schema::create('kpis', function (Blueprint $table) {
            $table->id(); $table->string('name'); $table->text('description')->nullable(); $table->timestamps();
        });
        Schema::create('consulting_cases', function (Blueprint $table) {
            $table->id(); $table->string('client_name'); $table->text('need_summary');
            $table->foreignId('problem_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('solution_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('kpi_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('consulting_cases'); Schema::dropIfExists('kpis'); Schema::dropIfExists('offer_tag'); Schema::dropIfExists('offer_solution'); Schema::dropIfExists('problem_solution'); Schema::dropIfExists('tags'); Schema::dropIfExists('offers'); Schema::dropIfExists('solutions'); Schema::dropIfExists('problems'); }
};

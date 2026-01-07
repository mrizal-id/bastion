<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi
            $table->foreignUuid('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('brand_id')->constrained('brands')->onDelete('restrict');

            // Penambahan Category Enum (Sesuai Fase 5 & 6)
            $table->enum('category', [
                'web_development',
                'mobile_development',
                'design_creative',
                'writing_translation',
                'marketing_sales',
                'video_animation',
                'other'
            ])->default('other');

            // Financials
            $table->decimal('total_budget', 19, 4);

            // Status Operasional & Escrow
            $table->enum('project_status', ['draft', 'active', 'completed', 'cancelled'])->default('draft');
            $table->enum('escrow_status', ['none', 'held', 'released', 'disputed', 'refunded'])->default('none');

            // Optimistic Locking & Audit
            $table->bigInteger('version')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // Indexing
            $table->index('category');
            $table->index('project_status');
            $table->index('brand_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}

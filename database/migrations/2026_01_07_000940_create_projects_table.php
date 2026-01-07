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

            // Relasi ke User (Client) dan Brand
            $table->foreignUuid('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('brand_id')->constrained('brands')->onDelete('restrict');

            // Financials
            $table->decimal('total_budget', 19, 4);

            // Status Operasional
            $table->enum('project_status', ['draft', 'active', 'completed', 'cancelled'])->default('draft');

            // Status Keamanan Uang (Escrow)
            $table->enum('escrow_status', ['none', 'held', 'released', 'disputed', 'refunded'])->default('none');

            // Optimistic Locking & Audit
            $table->bigInteger('version')->default(1);
            $table->timestamps();
            $table->softDeletes(); // Jaga-jaga jika ada sengketa data

            $table->index('project_status');
            $table->index('escrow_status');
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

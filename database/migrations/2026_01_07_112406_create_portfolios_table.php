<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi ke Brand (Pemilik)
            $table->foreignUuid('brand_id')->constrained('brands')->onDelete('cascade');

            // Relasi ke Project (Opsional - Sumber Kategori)
            $table->foreignUuid('project_id')
                ->nullable()
                ->unique()
                ->constrained('projects')
                ->onDelete('set null');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Tags sebagai pengganti kategori untuk upload manual
            $table->json('tags')->nullable();
            $table->string('live_url')->nullable();

            $table->boolean('is_published')->default(false);
            $table->integer('view_count')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexing untuk performa filter
            $table->index(['brand_id', 'is_published', 'created_at']);
            $table->index('project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabel Utama Review
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi - 1 Project hanya boleh punya 1 Review (Unique)
            $table->foreignUuid('project_id')->unique()->constrained('projects')->onDelete('cascade');
            $table->foreignUuid('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('brand_id')->constrained('brands')->onDelete('cascade');

            // Scoring Utama
            $table->unsignedTinyInteger('rating_score'); // 1-5
            $table->text('comment')->nullable();

            // Breakdown Detail
            $table->unsignedTinyInteger('professionalism_score')->nullable();
            $table->unsignedTinyInteger('quality_score')->nullable();
            $table->unsignedTinyInteger('communication_score')->nullable();

            // Respon Brand
            $table->text('reply_comment')->nullable();
            $table->timestamp('replied_at')->nullable();

            // Moderasi
            $table->boolean('is_hidden')->default(false);

            $table->timestamps();
            $table->softDeletes();
            // Indexing untuk filter cepat di profil brand
            $table->index(['brand_id', 'is_hidden', 'created_at']);
        });

        // 2. Performance Layer: Tabel Summary Rating
        Schema::create('brand_ratings_summary', function (Blueprint $table) {
            $table->foreignUuid('brand_id')->primary()->constrained('brands')->onDelete('cascade');
            $table->decimal('average_rating', 3, 2)->default(0); // Contoh: 4.85
            $table->integer('total_reviews')->default(0);
            $table->timestamp('last_updated')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('brand_ratings_summary');
        Schema::dropIfExists('reviews');
    }
};

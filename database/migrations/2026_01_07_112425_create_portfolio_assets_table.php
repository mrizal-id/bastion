<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_assets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('portfolio_id')->constrained('portfolios')->onDelete('cascade');
            $table->enum('asset_type', ['image', 'video', 'document', 'link']);
            $table->string('file_path');
            $table->boolean('is_thumbnail')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_assets');
    }
}

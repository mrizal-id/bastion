<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPorfolioLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_portfolio_link', function (Blueprint $table) {
            $table->foreignUuid('project_id')->unique()->constrained('projects');
            $table->foreignUuid('portfolio_id')->unique()->constrained('portfolios');
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
        Schema::dropIfExists('project_porfolio_links');
    }
}

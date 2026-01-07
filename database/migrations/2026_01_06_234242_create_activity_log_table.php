<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('log_name')->nullable()->index();
            $table->text('description');

            // Subjek (Model yang diubah, misal: Project/User)
            $table->string('subject_type')->nullable();
            $table->uuid('subject_id')->nullable();

            // Causer (Siapa yang mengubah, misal: Admin)
            $table->string('causer_type')->nullable();
            $table->uuid('causer_id')->nullable();

            $table->json('properties')->nullable();

            $table->timestamps();

            // Index manual untuk performa
            $table->index(['subject_id', 'subject_type'], 'subject_idx');
            $table->index(['causer_id', 'causer_type'], 'causer_idx');
        });
    }

    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}

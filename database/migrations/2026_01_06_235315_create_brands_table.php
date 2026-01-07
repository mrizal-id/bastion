<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            // Kita gunakan uuid() sebagai Primary Key sesuai desain Bastion
            $table->uuid('id')->primary();

            // Relasi ke User (Owner) - Harus UUID karena users.id adalah UUID
            $table->foreignUuid('owner_id')
                ->constrained('users')
                ->onDelete('restrict'); // Mencegah owner dihapus jika brand masih ada

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo_path')->nullable();

            // Fitur Fraud Detection: Limit transaksi harian
            $table->decimal('daily_limit', 19, 4)->default(0);
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
            $table->softDeletes(); // Penting untuk audit trail bisnis

            // Indexing untuk performa pencarian
            $table->index('name');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Product_brand', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->timestamps();
        });
        schema::table('products', function (Blueprint $table) {
            $table->dropColumn('brand');
            $table->foreignId('brand_id')->constrained('Product_brand')->onDelete('cascade')->nullable();
        });            
        }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_brand_name');
    }
};

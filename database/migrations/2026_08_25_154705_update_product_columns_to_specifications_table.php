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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['short_description', 'content']);
            
            $table->json('type')->nullable(); // Loại sản phẩm
            $table->json('style')->nullable(); // Kiểu
            $table->json('age')->nullable(); // Độ tuổi
            $table->json('drink_style')->nullable(); // Phong cách
            $table->json('processing_type')->nullable(); // Loại xử lý
            $table->json('packaging')->nullable(); // Bao bì
            $table->json('specialty')->nullable(); // Đặc sản
            $table->json('grade')->nullable(); // Lớp
            $table->json('shelf_life')->nullable(); // Thời hạn sử dụng
            $table->json('weight')->nullable(); // Trọng lượng
            $table->json('origin')->nullable(); // Nơi xuất xứ
            $table->json('brand_name')->nullable(); // Tên thương hiệu
            $table->json('model_number')->nullable(); // Số mô hình
            $table->json('payment_terms')->nullable(); // Điều khoản thanh toán
            $table->json('advantage')->nullable(); // Lợi thế
            $table->json('leaf_origin')->nullable(); // Nguồn gốc lá trà
            $table->json('material')->nullable(); // Chất liệu
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('short_description')->nullable();
            $table->json('content')->nullable();
            
            $table->dropColumn([
                'type', 'style', 'age', 'drink_style', 'processing_type', 
                'packaging', 'specialty', 'grade', 'shelf_life', 'weight', 
                'origin', 'brand_name', 'model_number', 'payment_terms', 
                'advantage', 'leaf_origin', 'material'
            ]);
        });
    }
};

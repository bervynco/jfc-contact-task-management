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
        Schema::table('tags_mapping', function (Blueprint $table) {
            // Recreate foreign key constraints
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('people_id')->references('id')->on('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags_mapping', function (Blueprint $table) {
            $table->dropForeign('business_id');
            $table->dropForeign('tag_id');
            $table->dropForeign('people_id');
        });
    }
};

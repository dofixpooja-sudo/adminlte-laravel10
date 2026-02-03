<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Only add subcategory_id if it doesn't exist
            if (!Schema::hasColumn('questions', 'subcategory_id')) {
                $table->unsignedBigInteger('subcategory_id')->after('id');
            }

            // Only add answer_type if it doesn't exist
            if (!Schema::hasColumn('questions', 'answer_type')) {
                $table->enum('answer_type', ['text', 'options'])->after('question');
            }
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Only drop if columns exist
            if (Schema::hasColumn('questions', 'subcategory_id')) {
                $table->dropColumn('subcategory_id');
            }

            if (Schema::hasColumn('questions', 'answer_type')) {
                $table->dropColumn('answer_type');
            }
        });
    }
};

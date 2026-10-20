<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->string('status')->default('todo')->after('body');
            $table->date('due_date')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn(['status', 'due_date']);
        });
    }
};

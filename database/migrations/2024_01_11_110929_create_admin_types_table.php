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
        Schema::create('admin_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId("admin_id")->constrained("admins")->onDelete("cascade");
            $table->enum('prive',[300,200,100]);
            $table->string("permissions",400);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_types');
    }
};

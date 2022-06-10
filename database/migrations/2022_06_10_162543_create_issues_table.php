<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\IssueType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->text('summary');
            $table->longText('description');
            $table->enum('priority', ['LOWEST','LOW','HIGH','HIGHEST']);
            $table->date('initial_date');
            $table->date('projected_end_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['COMPLETED', 'IN PROCESS', 'PENDING', 'DELAYED', 'CANCELED']);
            $table->unsignedBigInteger('assigne_id');
            $table->foreign('assigne_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('reporter_id');
            $table->foreign('reporter_id')->references('id')->on('users')->nullOnDelete();
            $table->foreignIdFor(IssueType::class)->constrained()->nullOnDelete();
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
        Schema::dropIfExists('issues');
    }
};

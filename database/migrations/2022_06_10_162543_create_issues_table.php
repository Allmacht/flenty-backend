<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\IssueType;
use App\Models\Priority;
use App\Models\Project;

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
            $table->integer('duration');
            $table->date('initial_date')->nullable();
            $table->date('projected_end_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['CREATED', 'COMPLETED', 'IN PROCESS', 'PENDING', 'DELAYED', 'CANCELED']);
            $table->unsignedBigInteger('assignee_id');
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('reporter_id');
            $table->foreign('reporter_id')->references('id')->on('users')->nullOnDelete();
            $table->foreignIdFor(Priority::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(IssueType::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Project::class)->constrained()->onDelete('CASCADE');
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

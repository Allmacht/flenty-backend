<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProjectType;
use App\Models\Company;
use App\Models\Client;
use App\Models\Line;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('name');
            $table->string('uuid')->unique()->index();
            $table->string('slug')->unique()->index();
            $table->string('image')->nullable();
            $table->longText('description');
            $table->date('initial_date');
            $table->date('projected_end_date');
            $table->timestamp('end_date')->nullable();
            $table->boolean('public')->default(true);
            $table->enum('status', ['CREATED', 'COMPLETED', 'IN PROCESS', 'PENDING', 'DELAYED', 'CANCELED']);
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('qa_id');
            $table->foreign('qa_id')->references('id')->on('users')->nullOnDelete();
            $table->foreignIdFor(Client::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Company::class)->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(Line::class)->constrained()->onDelete('CASCADE');
            $table->foreignIdFor(ProjectType::class)->constrained()->nullOnDelete();
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
        Schema::dropIfExists('projects');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGithubRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_repositories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id();
            $table->string('name', 255)->default('')->comment('项目名');
            $table->string('full_name', 255)->default('')->comment('项目全名');
            $table->text('description')->nullable($value = true)->comment('简介');
            $table->text('owner')->nullable($value = true)->comment('作者资料');
            $table->text('html_url')->nullable($value = true)->comment('网页地址');
            $table->text('original_data')->nullable($value = true)->comment('原始数据');
            $table->timestamps();

            $table->index('name');
            $table->index('full_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('github_repositories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';

            $table->id();
            $table->string('name', '255')->default('')->comment('名称');
            $table->string('server_website')->default('')->comment('服务商网站');
            $table->string('ip', '255')->default('')->comment('IP');
            $table->integer('port')->default(0)->comment('端口');
            $table->string('username', '255')->default('')->comment('用户名');
            $table->string('password', '255')->default('')->comment('密码');
            $table->dateTime('expire_date')->default(date('Y-m-d H:i:s', 0))->comment('到期日期');
            $table->string('control_panel_website', '255')->default('')->comment('控制面板网站');
            $table->string('control_panel_username', '255')->default('')->comment('控制面板用户名');
            $table->string('control_panel_password', '255')->default('')->comment('控制面板密码');
            $table->text('remark')->nullable($value = true)->comment('备注');

            $table->timestamps();

            $table->index('name');
            $table->index('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}

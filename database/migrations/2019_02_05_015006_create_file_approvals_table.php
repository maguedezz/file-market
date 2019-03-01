<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileApprovalsTable extends Migration
{

    public function up()
    {
        Schema::create('file_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->unsigned()->index();
            $table->string('title');
            $table->string('overview_short', 300);
            $table->string('overview');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_approvals');
    }
}

<?php namespace Leancode\Campaign\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMessageStatusesTable extends Migration
{

    public function up()
    {
        Schema::create('leancode_campaign_message_statuses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leancode_campaign_message_statuses');
    }

}

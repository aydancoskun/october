<?php namespace Leancode\Campaign\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSubscribersTable extends Migration
{

    public function up()
    {
        Schema::create('leancode_campaign_subscribers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('company_id', 100)->nullable()->index();
            $table->string('company_name', 100)->nullable()->index();
            $table->string('email', 100)->nullable()->index();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leancode_campaign_subscribers');
    }

}

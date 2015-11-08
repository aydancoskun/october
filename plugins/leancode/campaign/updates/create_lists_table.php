<?php namespace Leancode\Campaign\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateListsTable extends Migration
{

    public function up()
    {
        Schema::create('leancode_campaign_lists', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable()->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('leancode_campaign_lists_subscribers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('list_id')->unsigned();
            $table->integer('subscriber_id')->unsigned();
            $table->primary('subscriber_id', 'list_subscriber');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leancode_campaign_lists');
        Schema::dropIfExists('leancode_campaign_lists_subscribers');
    }

}

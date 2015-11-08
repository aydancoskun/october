<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Leancode\Campaign\Models\Message as MessageModel;

class MessagesAddStaggerTime extends Migration
{
    public function up()
    {
        Schema::table('leancode_campaign_messages', function($table)
        {
            $table->string('stagger_type')->nullable();
            $table->integer('stagger_count')->nullable();
        });

        MessageModel::where('is_staggered', true)->update(['stagger_type' => 'time']);
    }

    public function down()
    {
        Schema::table('leancode_campaign_messages', function($table)
        {
            $table->dropColumn('stagger_type');
            $table->dropColumn('stagger_count');
        });
    }

}

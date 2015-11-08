<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Leancode\Campaign\Models\Message as MessageModel;

class MessagesAddContentHtml extends Migration
{
    public function up()
    {
        Schema::table('leancode_campaign_messages', function($table)
        {
            $table->text('content_html')->nullable();
        });
    }

    public function down()
    {
        Schema::table('leancode_campaign_messages', function($table)
        {
            $table->dropColumn('content_html');
        });
    }

}

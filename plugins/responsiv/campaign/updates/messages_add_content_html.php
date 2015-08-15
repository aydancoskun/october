<?php namespace RainLab\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Responsiv\Campaign\Models\Message as MessageModel;

class MessagesAddContentHtml extends Migration
{
    public function up()
    {
        Schema::table('responsiv_campaign_messages', function($table)
        {
            $table->text('content_html')->nullable();
        });
    }

    public function down()
    {
        Schema::table('responsiv_campaign_messages', function($table)
        {
            $table->dropColumn('content_html');
        });
    }

}

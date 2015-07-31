<?php namespace RainLab\User\Updates;

use Carbon\Carbon;
use Schema;
use October\Rain\Database\Updates\Migration;
use Responsiv\Campaign\Models\Subscriber as SubscriberModel;

class SubscribersAddIpAddress extends Migration
{
    public function up()
    {
        Schema::table('responsiv_campaign_subscribers', function($table)
        {
            $table->string('created_ip_address')->nullable();
            $table->string('confirmed_ip_address')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->string('message_type')->nullable()->default('html');
        });

        SubscriberModel::whereNull('confirmed_at')->update(['confirmed_at' => new Carbon]);
    }

    public function down()
    {
        Schema::table('responsiv_campaign_subscribers', function($table)
        {
            $table->dropColumn('created_ip_address');
            $table->dropColumn('confirmed_ip_address');
            $table->dropColumn('confirmed_at');
            $table->dropColumn('message_type');
        });
    }

}

<?php namespace Leancode\Campaign\Updates;

use October\Rain\Database\Updates\Seeder;
use Leancode\Campaign\Models\MessageStatus;
use Leancode\Campaign\Models\SubscriberList;

class SeedTables extends Seeder
{

    public function run()
    {
        MessageStatus::create(['name' => 'Draft', 'code' => 'draft']);
        MessageStatus::create(['name' => 'Sent', 'code' => 'sent']);
        MessageStatus::create(['name' => 'Pending', 'code' => 'pending']);
        MessageStatus::create(['name' => 'Active', 'code' => 'active']);
        MessageStatus::create(['name' => 'Cancelled', 'code' => 'cancelled']);
        MessageStatus::create(['name' => 'Archived', 'code' => 'archived']);

        SubscriberList::create([
            'name' => 'Followers',
            'code' => 'followers',
            'description' => 'People who are interested in hearing about news.'
        ]);
    }

}

<?php namespace KurtJensen\Profile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('kurtjensen_profile_profiles', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('per_text_1')->nullable();
            $table->string('per_text_2')->nullable();
            $table->string('per_text_3')->nullable();
            $table->string('per_text_4')->nullable();
            $table->string('pro_text_1')->nullable();
            $table->string('pro_text_2')->nullable();
            $table->string('pro_text_3')->nullable();
            $table->string('pro_text_4')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kurtjensen_profile_profiles');
    }

}

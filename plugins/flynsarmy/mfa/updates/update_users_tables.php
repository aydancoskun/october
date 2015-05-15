<?php namespace Flynsarmy\Mfa\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateUsersTable extends Migration
{

    public function up()
    {
        Schema::table('backend_users', function($table)
        {
            $table->boolean('mfa_enabled')->default(false);
            $table->string('mfa_secret')->default('');
            $table->string('mfa_persist_code')->default('');
            $table->string('mfa_question_1')->default('');
            $table->string('mfa_answer_1')->default('');
            $table->string('mfa_question_2')->default('');
            $table->string('mfa_answer_2')->default('');
        });
    }

    public function down()
    {
        Schema::table('backend_users', function($table)
        {
            $table->dropcolumn('mfa_enabled');
            $table->dropColumn('mfa_secret');
            $table->dropColumn('mfa_persist_code');
            $table->string('mfa_question_1')->default('');
            $table->string('mfa_answer_1')->default('');
            $table->string('mfa_question_2')->default('');
            $table->string('mfa_answer_2')->default('');
        });
    }
}

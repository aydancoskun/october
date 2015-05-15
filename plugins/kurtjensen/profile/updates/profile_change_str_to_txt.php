<?php namespace KurtJensen\Profile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use DB;
class ProfileChangeStrToTxt extends Migration
{

    public function up()
    {
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN per_text_3 TEXT');
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN per_text_4 TEXT');
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN pro_text_3 TEXT');
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN pro_text_4 TEXT');           
    }

    public function down()
    {
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN per_text_3  VARCHAR(255)');
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN per_text_4  VARCHAR(255)');
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN pro_text_3  VARCHAR(255)');
            DB::statement('ALTER TABLE kurtjensen_profile_profiles MODIFY COLUMN pro_text_4  VARCHAR(255)');   

    }

}

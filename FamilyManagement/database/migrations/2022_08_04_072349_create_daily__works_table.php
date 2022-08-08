<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateDailyWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily__works', function (Blueprint $table) {
            $table->id();
            $table->string('works');
            $table->timestamps();
        });

        DB::table('daily__works')->insert(
            array(
                'id' => '1',
                'works' => 'Job',
            )
        );
        DB::table('daily__works')->insert(
            array(
                'id' => '2',
                'works' => 'Home Worker',
            )
        );
        DB::table('daily__works')->insert(
            array(
                'id' => '3',
                'works' => 'Outside Worker',
            )
        );
        DB::table('daily__works')->insert(
            array(
                'id' => '4',
                'works' => 'Marketing',
            )
        );



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily__works');
    }
}

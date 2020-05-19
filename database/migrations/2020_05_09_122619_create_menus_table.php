<?php
use App\menu;
use App\producto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

USE Illuminate\Support\Carbon;
class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->array('primeros');
            $table->array('segundos');
            $table->array('postres');
            $table->array('bebidas');
            $table->string('precio');
            $table->date('fecha');
            $table->timestamps();
        });

        $date = Carbon::now();

        $date = $date->format('Y-m-d');

        menu::create([
            'primeros' => ['dfdf','dfdfjj'],
            'segundos' => ['dfdf','dfdfjj'],
            'postres' => ['dfdf','dfdfgfgjj'],
            'bebidas' => ['dfdf','dfdfjj'],
            'precio' => '3.6',
            'fecha' => $date        ]);




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {



    Schema::connection($this->connection)->drop('menus');

    }
}

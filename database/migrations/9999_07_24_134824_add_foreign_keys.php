<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table -> unsignedBigInteger('type_id');

            $table -> foreign('type_id')
                -> references('id')
                -> on('types');

        });

        Schema::table('project_technology', function (Blueprint $table) {
            $table -> unsignedBigInteger('project_id');
            $table -> foreign('project_id')->references('id')->on('projects');
            $table -> unsignedBigInteger('technology_id');
            $table -> foreign('technology_id')->references('id')->on('technologys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table -> dropForeign('projects_type_id_foreign');
            $table -> dropColumn('type_id');
        });
        Schema::table('project_technology', function (Blueprint $table) {
            $table -> dropForeign('project_technology_project_id_foreign');
            $table -> dropForeign('project_technology_technology_id_foreign');
            $table -> dropColumn('project_id');
            $table -> dropColumn('technology_id');
        });
    }
};

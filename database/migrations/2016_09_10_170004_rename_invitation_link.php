<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameInvitationLink extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('managerreferenceusers', function ($table) {
                $table->renameColumn('invitation_link', 'confirmation_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('managerreferenceusers', function ($table) {
                $table->renameColumn('confirmation_code', 'invitation_link');
        });
    }
}

<?php

use App\Models\GymPackage;
use App\Models\Membership;
use App\LogMembershipStatusType;
use App\MemberType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Membership::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(GymPackage::class)->constrained()->cascadeOnDelete();
            $table->string('gym_package_name');
            $table->integer('price');
            $table->integer('duration');
            $table->enum('member_type', array_column(MemberType::cases(), 'value'));
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', array_column(LogMembershipStatusType::cases(), 'value'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_memberships');
    }
};

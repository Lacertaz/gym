<?php

use App\GenderType;
use App\MembershipStatus;
use App\MemberType;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('gender', array_column(GenderType::cases(), 'value'));
            $table->enum('member_type', array_column(MemberType::cases(), 'value'));
            $table->date('join_date');
            $table->date('expired_date');
            $table->string('no_whatsapp');
            $table->enum('status', array_column(MembershipStatus::cases(), 'value'))->default(MembershipStatus::NEW ->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};

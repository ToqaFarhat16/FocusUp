<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->date('booking_date');
            $table->timestamp('scheduled_start');
            // أوقات الجلسة الفعلية (تُعبأ عند مسح QR)
            $table->timestamp('actual_start')->nullable();
            $table->timestamp('actual_end')->nullable();
            // النتائج (تُحسب عند QR الخروج)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('table_id')->nullable()->constrained('tables')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->time('duration');
            $table->float('price');
            $table->decimal('hours', 8, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);

            $table->enum('status', [
                'active',
                'inactive',
                'pending',    // تم الحجز، لم يحن الوقت بعد,     // حان الوقت، الطاولة مشغولة (قبل أو بعد QR الدخول)
                'completed',  // انتهت الجلسة
                'cancelled',  // ملغى
                'no_show',

            ])->default('inactive');
            // Index يسرّع استعلام الـ Scheduler
            $table->index(['status', 'scheduled_start'], 'idx_status_scheduled_start');



            // $table->foreignId('consumption_packageid')->nullable()->constrained('consumption_packages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Services\Taqnyat\SMS;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendAppointmentSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appointments:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Sms To Tomorrow appointments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (setting()->taqnyat_key && setting()->taqnyat_status && setting()->taqnyat_sender ) {
            $tomorrowDate = Carbon::now()->addDay();
            $appointments = Appointment::where('appointment_date', $tomorrowDate->format('Y-m-d'))->get();
            if ($appointments) {
                foreach ($appointments as $appointment) {
                    if ($appointment->patient->phone) {
                        $phone = 966 . substr($appointment->patient?->phone, 1);
                        $message = 'نذكرك بموعدك غداً عند الطبيب ' . $appointment->doctor?->name . ' الساعة ' . $appointment->appointment_time . ' عيادة ' . $appointment->doctor?->department?->name;
                        $response = SMS::send([$phone], $message);
                        if (!in_array($response?->statusCode, [200, 201])) {
                            Log::info('خطأ في ارسال رسالة الي المريض ' . $appointment->patient?->name . ' برقم الهاتف : ' . $phone . ' الخطأ : ' . json_encode($response));
                        } else {
                            Log::info('تم ارسال التذكير الي ' . $phone . ' عن الموعد ' . $appointment->id);
                        }
                    }

                }
            }
        }
    }
}

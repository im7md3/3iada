<?php

namespace App\Http\Controllers\API;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{


    public function between($query)
    {
        if (\request()->from && \request()->to) {
            $query->whereBetween('created_at', [\request()->from, \request()->to]);
        } elseif (\request()->from) {
            $query->where('created_at', '>=', \request()->from);
        } elseif (\request()->to) {
            $query->where('created_at', '<=', \request()->to);
        } else {
            $query;
        }
    }
    public function index()
    {
        $morningTimesCount = 0;
        $eveningTimesCount = 0;
        $timesCount = 0;

        $appointments = Appointment::with('patient','doctor','clinic')->where(function ($query) {
            $this->between($query);
        })->where(function ($q) {
            if (\request()->department_id) {
                $q->where('clinic_id', \request()->department_id);
            }
            if (\request()->doctor_id) {
                $q->where('doctor_id', \request()->doctor_id);
            }
        })->latest()->get();

        $currentAppointments = Appointment::with('patient','doctor','clinic')->whereBetween(
            'appointment_time',
            [now()->subMinutes(30)->format('H:i'), now()->format('H:i')]
        )->get();


        $times = [];
        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        $reservedTimes = [];
        if (\request()->appointment_duration == 'morning' or \request()->appointment_duration == '') {
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
                $morningTimesCount += 2;
            }

            $timesCount += $morningTimesCount;
        }
        if (\request()->appointment_duration == 'evening' or \request()->appointment_duration == '') {

            for ($i = $from_evening; $i < $to_evening; $i++) {
                $times[] = $i . ':00';
                $times[] = $i . ':30';
                $eveningTimesCount += 2;
            }

            $timesCount += $eveningTimesCount;
        }

        $availableTimes = ($timesCount * 7) - $appointments->count();
        $departments = Department::all();
        $doctors = User::doctors()->where('department_id', \request()->department_id)->get();
        $reserved = $appointments->where('appointment_status', 'confirmed')->count();
        $present = $appointments->where('appointment_status', 'pending')->count();
       $converters =  $appointments->where('appointment_status', 'transferred')->count();
        $attended = $appointments->where('appointment_status', 'examined')->count();
        $cancelled = $appointments->where('appointment_status', 'cancelled')->count();

        $data = [
            'appointments' => $appointments,
            'currentAppointments' => $currentAppointments,
            'times' => $times,
            'availableTimes' => $availableTimes,
            'departments' => $departments,
            'doctors' => $doctors,
            'reservedAppointments' => $reserved,
            'presentAppointments' => $present,
            'convertersAppointments' => $converters,
            'attendedAppointments' => $attended,
            'cancelledAppointments' => $cancelled,
        ];

        return response()->json(['message' => "Data Retreived Successfully",'data' => $data],200);
    }
}

<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

function store_file($file, $path)
{
    $name = time() . $file->getClientOriginalName();
    return $value = $file->storeAs($path, $name, 'uploads');
}
function delete_file($file)
{
    if ($file != '' and !is_null($file) and Storage::disk('uploads')->exists($file)) {
        unlink('uploads/' . $file);
    }
}
function display_file($name)
{
    return asset('uploads') . '/' . $name;
}
function setting()
{
    return \App\Models\Setting::query()->first();
}
function doctor()
{
    return \App\Models\User::query()->find(auth()->id());
}


function getToothNumbers()
{
    return [18, 17, 16, 15, 14, 13, 12, 11, 21, 22, 23, 24, 25, 26, 27, 28, 38, 37, 36, 35, 34, 33, 32, 31, 41, 42, 43, 44, 45, 46, 47, 48];
}

function pregnancy()
{
    return [
        'الشهر',
        'الاول',
        'الثاني',
        'الثالث',
        'الرابع',
        'الخامس',
        'السادس',
        'السابع',
        'الثامن',
        'التاسع',
    ];
}

function isReserved($time, $reservedTimes)
{
    $currentTime = Carbon::parse($time);

    if (isset($reservedTimes[0]) && !is_string($reservedTimes[0])) {
        foreach ($reservedTimes as $rt) {
            $reservedStartTime = Carbon::parse($rt['appointment_time']);
            $reservedEndTime = isset($rt['appointment_time_end']) ? Carbon::parse($rt['appointment_time_end']) : Carbon::parse($rt['appointment_time'])->addMinutes(30);
            if ($currentTime->greaterThanOrEqualTo($reservedStartTime) && $currentTime->lessThan($reservedEndTime)) {
                return true;
            }
        }
    } else {
        return in_array($time, $reservedTimes);
    }

    return false;
}
function isEndReserved($time, $reservedTimes)
{
    $currentTime = Carbon::parse($time);
    foreach ($reservedTimes as $rt) {
        $reservedEndTime = Carbon::parse($rt['appointment_time_end']);
        if ($currentTime->equalTo($reservedEndTime)) {
            return true;
        }
    }
    return false;
}
function isAfterStartTime($time, $startTime = null)
{
    if (is_null($startTime)) {
        return true;
    }
    $currentTime = Carbon::parse($time);
    $startTime = Carbon::parse($startTime);
    if ($currentTime->gt($startTime)) {
        return true;
    }

    return false;
}

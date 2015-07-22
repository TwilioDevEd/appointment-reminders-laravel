<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function scopeAppointmentsDue($query)
    {
        $now = Carbon::now();
        $inTenMinutes = Carbon::now()->addMinutes(10);
        return $query->where('notificationTime', '>=', $now)->where('notificationTime', '<=', $inTenMinutes);
    }
}

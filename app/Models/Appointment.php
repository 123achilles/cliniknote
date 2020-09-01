<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $primaryKey = 'appointmentId';

    protected $fillable = [
//        'id',
        "genderPreference",
        "duration",
        "providerId",
        "appointmentId",
        "status",
        "startDateTime",
        "endDateTime",
        "notes",
        "staffRequested",
        "programId",
        "sessionTypeId",
        "locationId",
        "staffId",
        "clientId",
        "firstAppointment",
        "clientServiceId",
        "resources",
        "addOns",
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class,'clientId','clientId');
    }
}

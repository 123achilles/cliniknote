<?php


namespace App\Services\Api;


use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Http;

class AppointmentService extends BaseService
{
    /**
     * AppointmentService constructor.
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        $this->set_model($appointment);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAppointments($data)
    {
        if (empty($data)){
            $data['day'] = date('Y-m-d');
        }

        $appointments = Appointment::with('patient')->where('startDateTime', 'like', "%" . $data['day'] . "%")->get();
        return $appointments;
    }

}

<?php


namespace App\Http\Controllers\Api;


use App\Services\Api\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppointmentController extends BaseController
{
    /**
     * AppointmentController constructor.
     * @param AppointmentService $appointmentService
     */
    public function __construct(AppointmentService $appointmentService)
    {
        $this->baseService = $appointmentService;
    }

    public function getAppointments(Request $request)
    {
        $appointments = $this->baseService->getAppointments($request->all());
        return response()->json(['status' => 200,$appointments]);
    }


}

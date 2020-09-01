<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $siteId = config('app_settings.SiteId');
        $apiKey = config('app_settings.Api-Key');

        $res = Http::withHeaders([
            'SiteId' => $siteId,
//            'SiteId' => -99,
            'Api-Key' => $apiKey,
//            'Api-Key' => '3cd15b2058e14db69d0d9858936eeec8',
//Content-Type:application/json
//Accept:application/json
            'Authorization' => 'Bearer f05b645baeb9459497d240fc6883724d51c5e7c2de68446bb694998c39da490b'
        ])->get('https://api.mindbodyonline.com/public/v6/appointment/staffappointments');

        $appointmentsKeyUpper = json_decode($res->body(),true)['Appointments'];
        $appointments = array_map(function ($appointment){
            unset($appointment['Resources']);
//            $appointment['appointmentId'] = $appointment['Id'];
            return array_convert_key_case($appointment, 'lcfirst');

        }, $appointmentsKeyUpper);

        foreach ($appointments as $appointment){
            Appointment::updateOrCreate(['appointmentId' => $appointment['id']], $appointment);

            $resClinet = Http::withHeaders([
                'SiteId' => $siteId,
                'Api-Key' => $apiKey,
                'Authorization' => 'Bearer f05b645baeb9459497d240fc6883724d51c5e7c2de68446bb694998c39da490b'
            ])->get('https://api.mindbodyonline.com/public/v6/client/clients?clientIds='.$appointment['clientId']);
            $clientsKeyUpper = json_decode($resClinet->body(),true)['Clients'];//dd($clientsKeyUpper);
            $clients = array_map(function ($client){
                return array_convert_key_case($client, 'lcfirst');
            }, $clientsKeyUpper);

            Patient::updateOrCreate(['clientId' => $appointment['clientId']],$clients[0]);
        }

    }

}

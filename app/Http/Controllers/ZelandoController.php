<?php

namespace App\Http\Controllers;

use http\Exception;
use Illuminate\Http\Request;
use App\Http\Requests;

class ZelandoController extends Controller
{
    // space that we can use the repository from
    protected $authUrl = 'https://api.mindbodyonline.com/public/v6/usertoken/issue';
    protected $url = 'https://api.mindbodyonline.com/public/v6/';

    private $token;
    protected $key;

    public function __construct()
    {
        //$this->key = config('lemon-way.api-key');
    }

    /**
     * @param string $action
     * @return bool|string
     */
    public function getToken()
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->authUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                "grant_type=client_credentials");
            $headers = [
                'Content-Type: application/json',
                'SiteId:  -99',
                'Api-Key: b659dca6c5e1407db6093c9ad2c90d48',
            ];

            $body = [
                "Username" => "Siteowner",
                "Password" => "apitest1234"
            ];

            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($body));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
            }

            if (isset($error_msg)) {
                dd($error_msg);
            }
            $server_output = json_decode(curl_exec($ch));

            curl_close($ch);

//            $end = strtotime(sprintf('+%d seconds', $server_output->expires_in));
//            $end_date = date('Y-m-d H:i:s', $end);
            dd($server_output);

            //Session::put('lemon-way-token', $server_output);

            return $server_output;
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

    }
}

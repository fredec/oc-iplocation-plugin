<?php namespace DiveraMkt\IPLocation\Components;

use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;
use DiveraMkt\IPLocation\Models\Settings;

class IPLocation extends ComponentBase
{
    public $region_code;

    public function componentDetails()
    {
        return [
            'name'        => 'IPLocation',
            'description' => 'Get user location.'
        ];
    }

    public function defineProperties()
    {
        return [
        ];
    }

    public function onRun()
    {
        $settings = Settings::instance();

        if ($settings->api_service == 'google') {
            if (!$settings->google_api_key)
                throw new ApplicationException('Google Geolocation API key is not configured.');
            else
                $return = $this->geoGoogle(request()->ip(), $settings->google_api_key);

        } elseif ($settings->api_service == 'ipstack') {
            if (!$settings->ipstack_api_key)
                throw new ApplicationException('IPStack Access key is not configured.');
            else
                $return = $this->geoIPStack(request()->ip(), $settings->ipstack_api_key);
        }
        $this->region_code = $return['region_code'];
    }

    private function geoGoogle($ip, $api_key)
    {

    }

    private function geoIPStack($ip, $access_key)
    {
        // Initialize CURL:
        $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $api_result = json_decode($json, true);

        // Output the "capital" object inside "location"
        return $api_result;
    }
}

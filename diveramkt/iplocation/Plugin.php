<?php namespace Diveramkt\IPLocation;

use System\Classes\PluginBase;
use Illuminate\Support\Facades\Event;
use DiveraMkt\IPLocation\Models\Settings;

use Validator;
use ValidationException;
use ApplicationException;
use Log;

/* === API Documentation ===

IPStack: https://ipstack.com/documentation

*/

class Plugin extends PluginBase
{
    public $require = [
        'Martin.Forms'
    ];
    
    public function pluginDetails()
    {
        return [
            'name'        => 'IP Location',
            'description' => 'Provides User Location based on the IP number',
            'author'      => 'Frederico Marinho',
            'icon'        => 'icon-map-marker',
            'homepage'    => 'https://github.com/fredericomarinho/octplugin-iplocation'
        ];
    }

    public function registerComponents()
    {
        return [
            'DiveraMkt\IPLocation\Components\IPLocation' => 'ipLocation',
        ];
    }

    public function registerPermissions()
    {
        return [
            'diveramkt.iplocation.configure' => [
                'tab'   => 'IPLocation',
                'label' => 'Configure IPLocation Access Key.',
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'IP Location',
                'description' => 'Get user location by IP',
                'category'    => 'DiveraMkt',
                'icon'        => 'icon-map-marker',
                'class'       => 'DiveraMkt\IPLocation\Models\Settings',
                'order'       => 500,
                'keywords'    => 'divera sites user geo location place region area',
                'permissions' => ['IPLocation.manage_iplocation']
            ]
        ];
    }

}

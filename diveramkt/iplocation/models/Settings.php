<?php namespace Diveramkt\IPLocation\Models;

use Model;

class Settings extends Model
{
	use \October\Rain\Database\Traits\Validation;

    const SERVICE_IPSTACK = 'ipstack';
    const SERVICE_GOOGLE = 'google';

    const FIELD_API_SERVICE = 'api_service';
    const FIELD_IPSTACK_API_KEY = 'ipstack_api_key';
    const FIELD_GOOGLE_API_KEY = 'google_api_key';

    const IPSTACK_FIELDS = [
        self::FIELD_IPSTACK_API_KEY,
    ];

    const GOOGLE_FIELDS = [
        self::FIELD_GOOGLE_API_KEY,
    ];

    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'diveramkt_iplocation_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $rules = [
    ];

    /**
     * @param FormField[] $fields
     */
    public function filterFields($fields)
    {
        if ($fields->{self::FIELD_API_SERVICE}->value !== self::SERVICE_IPSTACK) {
            foreach (self::IPSTACK_FIELDS as $v) {
                $fields->{$v}->hidden = true;
                $fields->{$v}->disabled = true;
            }
        }
        if ($fields->{self::FIELD_API_SERVICE}->value !== self::SERVICE_GOOGLE) {
            foreach (self::GOOGLE_FIELDS as $v) {
                $fields->{$v}->hidden = true;
                $fields->{$v}->disabled = true;
            }
        }
    }
}

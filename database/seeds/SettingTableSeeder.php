<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create_new_config('APP_NAME_AR', '');
        $this->create_new_config('APP_NAME_EN', '');
        $this->create_new_config('APP_DESC_AR', '');
        $this->create_new_config('APP_DESC_EN', '');
        $this->create_new_config('PRIVACY_POLICY_AR', '');
        $this->create_new_config('PRIVACY_POLICY_EN', '');
        $this->create_new_config('ABOUT_AR', '');
        $this->create_new_config('ABOUT_EN', '');
        $this->create_new_config('TERMS_AR', '');
        $this->create_new_config('TERMS_EN', '');

        $this->create_new_config('SMTP_HOST', '');
        $this->create_new_config('SMTP_PORT', '');
        $this->create_new_config('SMTP_EMAIL', '');
        $this->create_new_config('SMTP_PASSWORD', '');

        $this->create_new_config('FCM_SENDER_ID', '');
        $this->create_new_config('FCM_SERVER_KEY', '');

        $this->create_new_config('FORMAL_EMAIL', '');
        $this->create_new_config('MOBILE', '');
        $this->create_new_config('WhatsApp', '');
        $this->create_new_config('FACEBOOK_URL', '');
        $this->create_new_config('TWITTER_URL', '');
        $this->create_new_config('INSTAGRAM_URL', '');
        $this->create_new_config('LINKEDIN_URL', '');
        $this->create_new_config('SNAPCHAT_URL', '');


        $this->create_new_config('ACTIVE_AUTO_4_NORMAL_USER', 'true');
        $this->create_new_config('IS_NEED_ADMIN_APPROVAL_4_NORMAL_USER', 'false');

        $this->create_new_config('ACTIVE_AUTO_4_FINTNESS_EXPERT', 'false');
        $this->create_new_config('IS_NEED_ADMIN_APPROVAL_4_FINTNESS_EXPERT', 'true');

        $this->create_new_config('ACTIVE_AUTO_4_NUTRITION_EXPERT', 'false');
        $this->create_new_config('IS_NEED_ADMIN_APPROVAL_4_NUTRITION_EXPERT', 'true');

        $this->create_new_config('ACTIVE_AUTO_4_RESTURANT', 'false');
        $this->create_new_config('IS_NEED_ADMIN_APPROVAL_4_RESTURANT', 'true');

        $this->create_new_config('ACTIVE_AUTO_4_GYM', 'false');
        $this->create_new_config('IS_NEED_ADMIN_APPROVAL_4_GYM', 'true');



        $this->create_new_config('APP_PERCENTAGE', '');
        $this->create_new_config('tax'           ,'75');
        $this->create_new_config('deleviery'     ,'10');

        $this->create_new_config('SMS_PROVIDER_TYPE', '');
        $this->create_new_config('SMS_PROVIDER_SENDER', '');
        $this->create_new_config('SMS_PROVIDER_MOBILE', '');
        $this->create_new_config('SMS_PROVIDER_PASSWORD', '');
    }

    function create_new_config($key, $value)
    {
        $setting = new Setting;
        $setting->key = $key;
        $setting->value = $value;
        $setting->save();
    }
}

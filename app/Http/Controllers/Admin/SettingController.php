<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Setting\SettingRepository;
use App\Models\Setting;
class SettingController extends Controller
{

    private $model;
    private $page;
    private $url;
    private $route;
    private $data;
    public function __construct(SettingRepository $setting)
    {
        $this->model = $setting;
        $this->page  = 'dashboard.cruds.settings.';
        $this->url   = '/settings';
        $this->route = 'settings.index';
        $this->data  = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings = Setting::all();

        return view($this->page.'index',compact('settings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->page.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->model->create($request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data added messages']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->getByID($id);
        return view($this->page.'show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->getByID($id);
        return view($this->page.'edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->model->update($id,$request->validated());
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data added messages']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->delete($id);
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'Data Deleted successfully']);
    }

    public function updateSetting(Request $request)
    {
        if ($request->APP_NAME_AR) {
            $this->update_setting('APP_NAME_AR', $request->APP_NAME_AR);
        }
        if ($request->APP_NAME_EN) {
            $this->update_setting('APP_NAME_EN', $request->APP_NAME_EN);
        }
        if ($request->APP_DESC_AR) {
            $this->update_setting('APP_DESC_AR', $request->APP_DESC_AR);
        }
        if ($request->APP_DESC_EN) {
            $this->update_setting('APP_DESC_EN', $request->APP_DESC_EN);
        }
        if ($request->FACEBOOK_URL) {
            $this->update_setting('FACEBOOK_URL', $request->FACEBOOK_URL);
        }
        if ($request->TWITTER_URL) {
            $this->update_setting('TWITTER_URL', $request->TWITTER_URL);
        }
        if ($request->INSTAGRAM_URL) {
            $this->update_setting('INSTAGRAM_URL', $request->INSTAGRAM_URL);
        }
        if ($request->SNAPCHAT_URL) {
            $this->update_setting('SNAPCHAT_URL', $request->SNAPCHAT_URL);
        }
        if ($request->MOBILE) {
            $this->update_setting('MOBILE', $request->MOBILE);
        }
        if ($request->FORMAL_EMAIL) {
            $this->update_setting('FORMAL_EMAIL', $request->FORMAL_EMAIL);
        }
        if ($request->SMTP_HOST) {
            $this->update_setting('SMTP_HOST', $request->SMTP_HOST);
        }
        if ($request->SMTP_PORT) {
            $this->update_setting('SMTP_PORT', $request->SMTP_PORT);
        }
        if ($request->SMTP_EMAIL) {
            $this->update_setting('SMTP_EMAIL', $request->SMTP_EMAIL);
        }
        if ($request->SMTP_PASSWORD) {
            $this->update_setting('SMTP_PASSWORD', $request->SMTP_PASSWORD);
        }
        if ($request->ABOUT_AR) {
            $this->update_setting('ABOUT_AR', $request->ABOUT_AR);
        }
        if ($request->ABOUT_EN) {
            $this->update_setting('ABOUT_EN', $request->ABOUT_EN);
        }
        if ($request->SMS_PROVIDER_SENDER) {
            $this->update_setting('SMS_PROVIDER_SENDER', $request->SMS_PROVIDER_SENDER);
        }
        if ($request->SMS_PROVIDER_MOBILE) {
            $this->update_setting('SMS_PROVIDER_MOBILE', $request->SMS_PROVIDER_MOBILE);
        }
        if ($request->SMS_PROVIDER_PASSWORD) {
            $this->update_setting('SMS_PROVIDER_PASSWORD', $request->SMS_PROVIDER_PASSWORD);
        }

        if ($request->PRIVACY_POLICY_AR) {
            $this->update_setting('PRIVACY_POLICY_AR', $request->PRIVACY_POLICY_AR);
        }
        if ($request->PRIVACY_POLICY_EN) {
            $this->update_setting('PRIVACY_POLICY_EN', $request->PRIVACY_POLICY_EN);
        }
        if ($request->TERMS_AR) {
            $this->update_setting('TERMS_AR', $request->TERMS_AR);
        }
        if ($request->TERMS_EN) {
            $this->update_setting('TERMS_EN', $request->TERMS_EN);
        }

        if ($request->WhatsApp) {
            $this->update_setting('WhatsApp', $request->WhatsApp);
        }

        if ($request->tax) {
            $this->update_setting('tax', $request->tax);
        }


        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'تم تحديث البيانات بنجاح']);

    }

    function update_setting($key, $value)
    {
        Setting::where('key', $key)->update(['value' => $value]);
        return true;
    }
}

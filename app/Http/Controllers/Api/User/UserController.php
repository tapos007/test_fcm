<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\ApiController;
use App\Traits\ApiResponse;
use App\User;
use Illuminate\Http\Request;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class UserController extends ApiController
{
    use ApiResponse;

    public function index(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'token' => 'required|unique:users,token'
        ];
        $this->validate($request, $rules);

        $data = $request->all();
        $data['password'] = bcrypt('secret');
        $data['name'] = 'adsfsdf';
        $user = User::create($data);
        return $this->showOne($user);
    }

    public function show()
    {
        $usrs =  User::all();
        return $this->showAll($usrs,200);
    }

    public function sendnotification(Request $request)
    {
        $rules = [
            'message' => 'required',
        ];
        $this->validate($request, $rules);
        $usrs =  User::all()->pluck('token')->toArray();




        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('please help people');
        $notificationBuilder->setBody($request->message)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

// You must change it to get your tokens


        $downstreamResponse = FCM::sendTo($usrs, $option, $notification);

        $downstreamResponse->numberSuccess();
        $info  = $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        return $this->showMessage($info,200);
    }

}

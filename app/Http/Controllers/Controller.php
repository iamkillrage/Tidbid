<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

require app_path() . '/AgoraToken/autoload.php';

use BoogieFromZk\AgoraToken\RtcTokenBuilder2;
use BoogieFromZk\AgoraToken\ChatTokenBuilder2;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $appId = 'e59366bc6d64449b9137b2e7c1a63209';
    public $appCertificate = '64d4d7a662424ad89163b1e866da949b';

    public function sendResponse($result, $message)
    {
        if ($result != []) {
            $response = [
                'success' => true,
                "code" => 200,
                'message' => $message,
                'data'    => $result
            ];
        } else {
            $response = [
                'success' => true,
                "code" => 200,
                'message' => $message

            ];
        }
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'code' => 404,
            'message' => $error

        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function getToken($channelName, $uid = '')
    {
        $expireTimeInSeconds = 7200;
        $role = RtcTokenBuilder2::ROLE_PUBLISHER;

        $token = RtcTokenBuilder2::buildTokenWithUid($this->appId, $this->appCertificate, $channelName, $uid, $role, $expireTimeInSeconds);

        return $token;
    }

    public function getChatToken($uid)
    {
        $expireTimeInSeconds = 7200;

        $token = ChatTokenBuilder2::buildUserToken($this->appId, $this->appCertificate, $uid, $expireTimeInSeconds);

        return $token;
    }

    public function getAppToken()
    {
        $expireTimeInSeconds = 7200;

        $token = ChatTokenBuilder2::buildAppToken($this->appId, $this->appCertificate, $expireTimeInSeconds);

        return $token;
    }

    public function createAgoraAccount($uid, $name)
    {
        // Prepare the JSON payload
        $payload = json_encode(array(
            "username" => $uid,
            "nickname" => $name
        ));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://a61.easemob.com/611193818/1381443/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->getAppToken()
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccessTokenService;
use App\Models\StreamManagement;

require app_path() . '/AgoraToken/autoload.php';

use BoogieFromZk\AgoraToken\RtcTokenBuilder2;

class Token extends Controller
{
    public $appId = 'e59366bc6d64449b9137b2e7c1a63209';
    public $appCertificate = '64d4d7a662424ad89163b1e866da949b';

    public function generateToken(Request $request)
    {
        $channelName = '1-2'; // $request->input('channelName');
        $uid = 1; //$request->input('uid');
        $expireTimeInSeconds = 3600; // Token valid for 1 hour
        $expireTimestamp = time() + $expireTimeInSeconds;

        $tokenGenerator = new AccessTokenService($this->appId, $this->appCertificate, $channelName, $uid, $expireTimestamp);
        $token = $tokenGenerator->build();

        return response()->json(['token' => $token]);
    }

    public function generateRtcToken(Request $request)
    {
        $channelName = $request->input('channelName');
        $uid = $request->input('uid');
        $expireTimeInSeconds = 7200;
        $role = RtcTokenBuilder2::ROLE_PUBLISHER;

        $token = RtcTokenBuilder2::buildTokenWithUid($this->appId, $this->appCertificate, $channelName, $uid, $role, $expireTimeInSeconds);

        return response()->json(['token' => $token]);
    }

    public function start_recording(Request $request)
    {
        $streamId   = $request->id;
        $resourceId = $request->resourceId;
        $channel    = $request->channel;
        $token      = $request->token;
        $uid        = $request->uid;

        $body = [
            "cname" => $channel,
            "uid"   => "$uid",
            "clientRequest" => [
                "token" => $token,
                "recordingConfig" => [
                    "streamTypes"       => 2,
                    "channelType"       => 1,
                    "videoStreamType"   => 0,
                    "transcodingConfig" => [
                        "height"            => 450,
                        "width"             => 650,
                        "bitrate"           => 500,
                        "fps"               => 15,
                        "mixedVideoLayout"  => 0,
                        "backgroundColor"   => "#000000"
                    ],
                ],
                "recordingFileConfig" => [
                    "avFileType" => [
                        "hls",
                        "mp4"
                    ]
                ],
                "storageConfig" => [
                    "vendor"    => 1,
                    "region"    => 1,
                    "bucket"    => "tidbidstore",
                    "accessKey" => "accessKey",
                    "secretKey" => "secretKey"
                ]
            ]
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.agora.io/v1/apps/' . $this->appId . '/cloud_recording/resourceid/' . $resourceId . '/mode/mix/start',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic YTA1MDJlMWQ4ZmJiNDRkMDllZjlhNjBmNmRhOGM1OGY6YmI0MDhjZDg2NWY2NDBiODk1OWMwYmJkYTZlODNmNjM='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        $result['recordingStatus'] = $this->check_recording($streamId, $result['resourceId'], $result['sid']);

        echo json_encode($result);
    }

    private function check_recording($streamId, $resourceId, $sid)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.agora.io/v1/apps/' . $this->appId . '/cloud_recording/resourceid/' . $resourceId . '/sid/' . $sid . '/mode/mix/query',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic YTA1MDJlMWQ4ZmJiNDRkMDllZjlhNjBmNmRhOGM1OGY6YmI0MDhjZDg2NWY2NDBiODk1OWMwYmJkYTZlODNmNjM='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['code']) && $result['code'] == 404) {
            return false;
        }

        StreamManagement::where('id', $streamId)->update(['sid' => $sid]);

        return true;
    }

    public function stop_recording(Request $request)
    {
        $resourceId = $request->resourceId;
        $channel    = $request->channel;
        $sid        = $request->sid;
        $uid        = $request->uid;

        $body = [
            "cname" => $channel,
            "uid"   => "$uid",
            "clientRequest" => [
                "async_stop" => false
            ]
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.agora.io/v1/apps/' . $this->appId . '/cloud_recording/resourceid/' . $resourceId . '/sid/' . $sid . '/mode/mix/stop',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic YTA1MDJlMWQ4ZmJiNDRkMDllZjlhNjBmNmRhOGM1OGY6YmI0MDhjZDg2NWY2NDBiODk1OWMwYmJkYTZlODNmNjM='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        if (!isset($result['code'])) {
            if ($result['serverResponse']['uploadingStatus'] == 'uploaded') {
                StreamManagement::where('sid', $sid)->update(['recorded' => true, 'bid_end_status' => 1, 'fileList' => json_encode($result['serverResponse']['fileList'])]);
            }
        }

        return $result;
    }
}

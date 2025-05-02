<?php

namespace App\Services;

class AccessTokenService
{
    private $appId;
    private $appCertificate;
    private $channelName;
    private $uid;
    private $expireTimestamp;

    public function __construct($appId, $appCertificate, $channelName, $uid, $expireTimestamp)
    {
        $this->appId = $appId;
        $this->appCertificate = $appCertificate;
        $this->channelName = $channelName;
        $this->uid = $uid;
        $this->expireTimestamp = $expireTimestamp;
    }

    public function build()
    {
        // Create a signature
        $message = $this->appId . $this->uid . $this->channelName . $this->expireTimestamp;
        $signature = hash_hmac('sha256', $message, $this->appCertificate, true);

        // Encode the token
        $token = base64_encode($signature . $message);

        return $token;
    }
}

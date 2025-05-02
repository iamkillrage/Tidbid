<?php

namespace App\Services;

use DateTime;
use DateTimeZone;

class AccessTokenService
{
    const Privileges = [
        "kRtmLogin" => 1000,
    ];

    private $appID;
    private $appCertificate;
    private $uid;
    private $salt;
    private $ts;
    private $privileges;

    public function __construct($appID, $appCertificate, $uid)
    {
        $this->appID = $appID;
        $this->appCertificate = $appCertificate;
        $this->uid = $uid;

        $this->salt = rand(0, 100000);
        $this->ts = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp() + 24 * 3600;
        $this->privileges = [];
    }

    public function addPrivilege($key, $expireTimestamp)
    {
        $this->privileges[$key] = $expireTimestamp;
        return $this;
    }

    public function build()
    {
        $msg = $this->packContent();
        $val = array_merge(unpack("C*", $this->appID), unpack("C*", $this->uid), $msg);

        $sig = hash_hmac('sha256', implode(array_map("chr", $val)), $this->appCertificate, true);

        $crc_uid = crc32($this->uid) & 0xffffffff;

        $content = array_merge($this->packString($sig), unpack("C*", pack("V", $crc_uid)), unpack("C*", pack("v", count($msg))), $msg);
        $version = "006";
        return $version . $this->appID . base64_encode(implode(array_map("chr", $content)));
    }

    private function packContent()
    {
        $buffer = unpack("C*", pack("V", $this->salt));
        $buffer = array_merge($buffer, unpack("C*", pack("V", $this->ts)));
        $buffer = array_merge($buffer, unpack("C*", pack("v", sizeof($this->privileges))));
        foreach ($this->privileges as $key => $value) {
            $buffer = array_merge($buffer, unpack("C*", pack("v", $key)));
            $buffer = array_merge($buffer, unpack("C*", pack("V", $value)));
        }
        return $buffer;
    }

    private function packString($value)
    {
        return unpack("C*", pack("v", strlen($value)) . $value);
    }
}

<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Monolog
{
    /**
     * save to log.
     *
     * @param $channelName (example: loginPage.info)
     * @param $loggerType (I = Info, W = Warning, E = ERROR) Default = I
     * @return $this
     */
    static function saveLog($channelName = "default-channel", $loggerType = "I", $msg = "")
    {

        $path = './logs/';


        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $logger = new Logger($channelName);
        $logger->pushHandler(new StreamHandler($path . date('d_m_Y') . '_app.log', Logger::DEBUG));

        if (strtoupper($loggerType) == "I") {
            $logger->info($msg);
        }

        if (strtoupper($loggerType) == "W") {
            $logger->warning($msg);
        }

        if (strtoupper($loggerType) == "E") {
            $logger->error($msg);
        }
    }
}

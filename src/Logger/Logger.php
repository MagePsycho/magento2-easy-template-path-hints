<?php

namespace MagePsycho\Easypathhints\Logger;

/**
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Logger extends \Monolog\Logger
{
    public function customLog($message)
    {
        try {
            if (is_null($message)) {
                $message = "NULL";
            }
            if (is_array($message)) {
                $message = json_encode($message, JSON_PRETTY_PRINT);
            }
            if (is_object($message)) {
                $message = json_encode($message, JSON_PRETTY_PRINT);
            }
            if (!empty(json_last_error())) {
                $message = (string)json_last_error();
            }
            $message = (string)$message;
        } catch (\Exception $e) {
            $message = "INVALID MESSAGE";
        }
        $message .= "\r\n";
        $this->info($message);
    }
}
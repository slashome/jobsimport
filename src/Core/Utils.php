<?php

namespace Core;

class Utils {

    public static function printMessage(string $message, array $messageParameters = []): void
    {
        echo strtr($message."\n", $messageParameters);
    }

}

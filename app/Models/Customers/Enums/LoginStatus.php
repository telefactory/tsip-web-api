<?php

namespace App\Models\Customers\Enums;

use BenSampo\Enum\Enum;

final class LoginStatus extends Enum
{
    const LOGGED_ON = "LOGGED_ON";
    const LOGGED_OFF = "LOGGED_OFF";
}

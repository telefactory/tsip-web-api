<?php

namespace App\Models\Customers\Enums;

use BenSampo\Enum\Enum;

final class ScheduleType extends Enum
{
    const MANUAL = "MANUAL";
    const WEEKLY = "WEEKLY";
    const ADVANCED = "ADVANCED";
}

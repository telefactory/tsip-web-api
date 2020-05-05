<?php

namespace App\Models\Customers\Enums;

use BenSampo\Enum\Enum;

final class ManualState extends Enum
{
    const CLOSED = "CLOSED";
    const OPEN = "OPEN";
    const UNKNOWN = "UNKNOWN";
}

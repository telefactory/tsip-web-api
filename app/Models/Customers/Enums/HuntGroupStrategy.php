<?php

namespace App\Models\Customers\Enums;

use BenSampo\Enum\Enum;

final class HuntGroupStrategy extends Enum
{
    const LINEAR = "LINEAR";
    const CIRCULAR = "CIRCULAR";
    const RING_ALL = "RING_ALL";
    const RANDOM = "RANDOM";
}

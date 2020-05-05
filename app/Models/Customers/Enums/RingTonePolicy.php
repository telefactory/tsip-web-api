<?php

namespace App\Models\Customers\Enums;

use BenSampo\Enum\Enum;

final class RingTonePolicy extends Enum
{
    const TRUE_RINGING = "TRUE_RINGING";
    const FAKE_RINGING = "FAKE_RINGING";
    const MUSIC = "MUSIC";
}

<?php

namespace App\Models\Customers\Enums;

use BenSampo\Enum\Enum;

final class AnswerHuntGroupPolicy extends Enum
{
    const NO_ANSWER = "NO_ANSWER";
    const BEFORE = "BEFORE";
    const AFTER = "AFTER";
}

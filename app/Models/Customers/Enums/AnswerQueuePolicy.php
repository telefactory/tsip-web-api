<?php

namespace App\Models\Customers\Enums;

use BenSampo\Enum\Enum;

final class AnswerQueuePolicy extends Enum
{
    const NO_ANSWER = "NO_ANSWER";
    const ON_ENTER = "ON_ENTER";
    const BEFORE = "BEFORE";
    const AFTER = "AFTER";
}

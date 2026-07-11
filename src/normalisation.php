<?php
declare(strict_types=1);

function normaliseMileage(?string $mil) {
    if (!$mil) {
        return null;
    }
    $normalised = str_replace(' ', '', $mil);
    return filter_var($normalised, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
}
function normaliseFuelConsumption(?string $fc) {
    if (!$fc) {
        return null;
    }
    $normalised = explode(" ",$fc);
    return filter_var($normalised[0], FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
}

function normaliseAcceleration(?string $acc) {
    if (!$acc) {
        return null;
    }
    $normalised = str_replace("s", '', $acc);
    return filter_var($normalised, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
}
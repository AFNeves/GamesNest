<?php

namespace App\Enums;

enum Provider: String
{
    case Card = 'Card';
    case MBWay = 'MBWay';
    case PayPal = 'PayPal';
    case Revolut = 'Revolut';
}

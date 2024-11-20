<?php

namespace App\Enums;

enum ProductType: String
{
    case DLC = 'DLC';
    case Game = 'Game';
    case GamePoints = 'Game Points';
    case Subscription = 'Subscription';
}

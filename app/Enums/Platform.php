<?php

namespace App\Enums;

enum Platform: String
{
    case PSN = 'PSN';
    case Steam = 'Steam';
    case Origin = 'Origin';
    case Nintendo = 'Nintendo';
    case XboxLive = 'Xbox Live';
    case EpicGames = 'Epic Games';
    case WindowsStore = 'Windows Store';
    case UbisoftConnect = 'Ubisoft Connect';
    case RockstarGamesLauncher = 'Rockstar Games Launcher';
}

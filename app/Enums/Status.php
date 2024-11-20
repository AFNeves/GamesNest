<?php

namespace App\Enums;

enum Status: String
{
    case Completed = 'Completed';
    case Rejected = 'Rejected';
    case WaitingPayment = 'Waiting Payment';
    case WaitingKey = 'Waiting Key';
    case WaitingDelivery = 'Waiting Delivery';
    case Delivered = 'Delivered';
}

<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;
#[
    OA\Info(version: "1.0", description: "Test Reserva Online", title: "Reserva Online API"),
    OA\Server(url: 'http://127.0.0.1', description: 'Test rese'),
]
abstract class Controller
{
    //
}

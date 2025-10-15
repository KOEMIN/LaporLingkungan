<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // <-- (1) PASTIKAN INI ADA
use Illuminate\Foundation\Validation\ValidatesRequests;   // <-- (2) PASTIKAN INI ADA
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests; // <-- (3) PASTIKAN BARIS INI ADA
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Status
    public $successStatus       = 200;
    public $errorStatus         = 500;
    public $errorArray          = [ 'status' => 'error' ];
    public $successArray        = [ 'status' => 'success' ];
    public $notFoundStatus      = 404;
    public $unauthorizedStatus  = 401;

}

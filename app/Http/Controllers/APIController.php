<?php

namespace App\Http\API\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *      version="0.0.1",
 *      title="Some API",
 *      description="Laracom api documentation",
 *      @OA\Contact(
 *          email="hamza_mostafa@zoho.com"
 *      )
 * )
 */
// *  OA\Server(
// *       url=env('APP_URL'),
// *       description=env('APP_NAME')
// *  )

class APIController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function loggedUser()
    {
        return auth()->user();
    }
}

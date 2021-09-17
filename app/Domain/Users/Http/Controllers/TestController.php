<?php

namespace App\Domain\Users\Http\Controllers;

use App\Application\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * @OA\Info(title="My First API test", version="1")
     * @OA\Get(
     *     path="api/test",
     *     description="Home page",
     *     @OA\Response(response="default", description="Test api")
     * )
     */
    public function test()
    {

    }
}

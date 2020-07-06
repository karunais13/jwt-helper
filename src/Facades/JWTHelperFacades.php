<?php
namespace Karu\JWTHelper\Facades;

use Illuminate\Support\Facades\Facade;

class JWTHelperFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '\Karu\JWTHelper\Helpers\JWTHelper';
    }
}

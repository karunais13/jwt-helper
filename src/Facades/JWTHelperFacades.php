<?php
namespace Karu\CustomSignature\Facades;

use Illuminate\Support\Facades\Facade;

class JWTHelperFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return '\Karu\JWTHelper\Helpers\JWTHelper';
    }
}

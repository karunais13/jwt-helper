<?php

namespace Karu\JWTHelper\Helpers;

use \Firebase\JWT\JWT;

class JWTHelper
{

    private $payload;
    private $alg;

    public function encode($payload, $algorithms=null): string
    {
        $this->setPayload($payload);

        $this->setAlgorithms($algorithms);
        
        return JWT::encode($this->payload, $this->getKey($algorithms, false), $this->alg);
    }

    public function decode($token, $algorithms=null): array
    {
        $this->setupLeeway();

        $this->setAlgorithms($algorithms);

        $decoded = JWT::decode($token, $this->getKey($algorithms), [$this->alg]);

        return (array)$decoded;
    }


    private function setupLeeway()
    {
        return JWT::$leeway = config('jwttoken.leeway');
    }

    private function getKey($algorithms, $decode=true)
    {
        if(!isset($algorithms)) $algorithms = config('jwttoken.default.algorithm', 'HS256');
        
        switch ($algorithms){
            case 'HS256' :
            case 'HS384' :
            case 'HS512' :
                return config("jwttoken.{$algorithms}.public");
                break;
            case 'RS256' :
            case 'RS384' :
            case 'RS512' :
                if( $decode ){
                    if( config("jwttoken.{$algorithms}.is_path") ){
                        $key = file_get_contents(config("jwttoken.{$algorithms}.public"));
                    }else{
                        $key = config("jwttoken.{$algorithms}.public");
                    }
                }else{
                    if( config("jwttoken.{$algorithms}.is_path") ){
                        $key = file_get_contents(config("jwttoken.{$algorithms}.private"));
                    }else{
                        $key = config("jwttoken.{$algorithms}.private");
                    }
                }
                return $key;
                break;
            default :
                return config("jwttoken.{$algorithms}.public", null);
                break;
        }
    }

    private function setPayload($publicClaim)
    {

        $min = config('jwttoken.claims.exp') ?? 5;

        $registeredCliam = [
            'iss' => config('jwttoken.claims.iss'),
            'exp' => strtotime("+{$min} minutes"),
            'sub' => config('jwttoken.claims.sub'),
            'nbf' => time(),
            'iat' => time()
        ];

        if( !is_array($publicClaim) ){
            $publicClaim = is_object($publicClaim) ? (array)$publicClaim : [$publicClaim];
        }

        $payload = array_merge($registeredCliam, $publicClaim);

        $this->payload = $payload;

        return $this->payload;
    }

    private function setAlgorithms($agl): void
    {
        if( is_array($agl) && count($agl) > 0 ){
            $this->alg = !empty($agl[0]) ?  config("jwttoken.$agl[0].algorithm"): config('jwttoken.default.algorithm');
        }else{
            $this->alg = !empty($agl) ? config("jwttoken.$agl.algorithm") : config('jwttoken.default.algorithm');
        }
    }
}

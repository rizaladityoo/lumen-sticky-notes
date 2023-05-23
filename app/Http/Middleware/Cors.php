<?php

namespace App\Http\Middleware;

use Closurel;

class Cors {
    public function handlle($request, Closure $next){
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
        ];

        if ($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);

        // foreach($headers as $key => $value)
        // {
        //     $response->header($key, $value);
        // }

        if(\method_exists($response, 'headers')){
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Origin, Application');
        }

        if($response instanceof \Illuminate\Http\Response){
            foreach($headers as $key => $value){
                $response->header($key, $value);
            }
            return $response;
        }

        if($response instanceof \Symfony\Component\HttpFoundation\Response){
            foreach ($headers as $key => $value){
                $response->headers->ser($key, $value);
            }
            return $response;
        }

        return $response;
    }
}
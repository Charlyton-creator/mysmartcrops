<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PortefeuilParticulier;
use App\Models\Particulier;

class CheckPortefeuilAmount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $Total = $request->input('sous_total');
        $portefeuil = auth('particulier')->user()->portefeuil;
        if($Total > $portefeuil->amount){
            return redirect('/particuliers/recharger-compte');
        }
        return $next($request);
    }
}

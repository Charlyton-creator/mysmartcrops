<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recharge;
use App\Models\Particulier;
use App\Models\PortefeuilParticulier;

use Validator;

class RechargController extends Controller
{
    //

    public function initialiser(Request $request){
        $validator = Validator::make($request->all(), ["amount"=>'required']);

        if($validator->fails()){
            return redirect()->back();
        }

        if(!auth('particulier')->check()){
            return redirect()->back();
        }

        $particulier = auth('particulier')->user();

        $recharge = new Recharge();

        $recharge->particulier()->associate($particulier);

        $recharge->amount = $request->amount;

        $recharge->statut = "initialiseé";

        $recharge->save();
        return view('appviews.payment-terminate', compact('recharge'));
    }

    public function callback(Request $request, $recharge_id){
        $transaction_id = $recharge_id;
        if(isset($_POST['field'])){
            switch($request['transaction-status']){
                case 'approved':
                    Recharge::where('id', $transaction_id)->update(['transaction_id' => $request['transaction-id'], 'statut' => 'approved']);
                    $particulier_id = Recharge::where('id', $transaction_id)->first()->particulier_id;
                    $portefeuil = PortefeuilParticulier::where('particulier_id', $particulier_id)->first();
                    $montant_init = $portefeuil->amount;
                    $amount = Recharge::where('id', $transaction_id)->first()->amount;
                    PortefeuilParticulier::where('particulier_id', $particulier_id)->update(['amount' => $montant_init + $amount]);
                    return redirect(route('recharge-portefeuil'))->with('payementsuccess', 'Payement effectué avec succes. Votre candidature est maintenant au complet et recupérable par l organisateur. Merci pour votre confiance');
                    break;
                case 'created':
                    break;
                case 'canceled':
                    Recharge::where('id', $transaction_id)->update(['transaction_id' => $request['transaction-id'], 'statut' => 'canceled']);
                    return redirect(route('recharge-portefeuil'))->with('payementcancelled', 'Vous avez annuler le payement. Si vous souhaitez continuer, veuillez relancer une transaction');
                    break;
                default:
                    return redirect(route('recharge-portefeuil'))->with('payementcancelled', 'Vous avez annuler le payement. Si vous souhaitez continuer, veuillez relancer une transaction');
                    break;
            }
        }
    }
}

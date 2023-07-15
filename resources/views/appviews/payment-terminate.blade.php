<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/pay.css')}}">
    <title>Payment Page</title>
</head>
<body>
<div class="alert information-alert">
    <p><br>
        Nb: Des frais de transactions s'appliqueront.
        Cliquez sur le boutton Payer en bas pour continuer! <br>
        MySmartCrops ne prend pas en compte les remboursements. <br> Une fois vous payer, vous ne serez plus en mésure
        de demander un remboursement. Sauf en cas de demande de demande approuvée</p>
</div>	
<form method="POST" action="{{route('callbackurl', ['recharge_id'=>$recharge->id])}}">
    @csrf
    <input type="hidden" name="field" value="test">
    <script 
        src="https://cdn.fedapay.com/checkout.js?v=1.1.7" 
        data-public-key="pk_live_pnJ2DEO2pG4MkxI1hUw8o1dQ" 
        data-button-text="Payer {{$recharge->amount}}" 
        data-button-type='submit'
        data-button-class="btn btn-primary w-25" 
        data-transaction-amount="{{$recharge->amount}}" 
        data-transaction-description="Payement Pour la Recharge" 
        data-currency-iso="XOF">
    </script>
</form>
<a class="btn btn-danger btn-separate" href="/dashboard">Annuler et retourner</a> 
</body>
</html>
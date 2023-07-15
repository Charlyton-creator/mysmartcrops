<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <title>MySmartCrops - Shopping Cart</title>
</head>
<body>
    {{-- cart-add --}}
    <section id="cart-add" class="section-p1">
        <div class="information-alert">
            <i class="bx bx-info-circle"></i>
            <span>Cette action est irréversible. Votre portefeuille sera débité une fois la commande lancée. Veuillez vous assurer d'être prêt avant de procéder au paiement.</span>
        </div>
        <div id="coupon">
            <div id="alert-container">
            <h3>Informations pour la Livraison</h3>
            <div>
                <input type="text" placeholder="Entrez l'adresse de réception ici"> <br> <br>
                <button class="normal">Terminer et Payer</button>
            </div>
        </div>
    </section>       
    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script>
var csrfToken = '{{ csrf_token() }}';
// Fonction pour mettre à jour la quantité d'un produit dans le panier
$(document).ready(function() {
    // Lorsque le bouton "Appliquer" est cliqué pour l'adresse de livraison
    $('#coupon button').on('click', function() {
        // Récupérer l'adresse de livraison saisie
        var adresseLivraison = $('input[type="text"]').val();

        // Effectuer la requête AJAX vers le backend
        $.ajax({
            url: '/' + {{$commandeId}} + '/livraison_place',
            method: 'PUT',
            data: {
                _token : csrfToken,
                adresse: adresseLivraison
            },
            success: function(response) {
                // Récupérer la commande mise à jour

                showAlert('Vous avez effectué la validation et le Payement avec Succès. Suivez sur votre dashboard le statut de votre commande', 'success');
            },
            error: function(xhr, status, error) {
                // Afficher le message d'erreur

                showAlert(xhr.responseText, 'error');
            }
        });
    });
     // Fonction pour afficher une alerte personnalisée
     function showAlert(message, type) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-error';
        var alertHtml = '<div class="alert ' + alertClass + '">';

            if (type === 'success') {
            // Ajouter un lien pour compléter le processus et payer
                alertHtml += message + '';
            } else {
                alertHtml += message;
            }

        alertHtml += '</div>';
    
        $('#alert-container').html(alertHtml);
    }
});
</script>

</body>
</html>
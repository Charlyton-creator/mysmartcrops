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
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Supprimmer</td>
                    <td>Image</td>
                    <td>Produit</td>
                    <td>Prix</td>
                    <td>Quantite</td>
                    <td>SousTotal</td>
                </tr>
            </thead>
            <tbody> 
                <div id="alert-container">
                </div>                 
                @if (empty($panierItems))
                    
                @endif
                @php
                    $sous_total = 0;
                @endphp
                @foreach ($panierItems as $item)
                    <tr>
                        <td><a href="#" class="supprimer-produit" data-panier-item-id="{{$item->id}}"><i class="fas fa-times-circle"></i></a></td>
                        <td>
                            <img src="{{asset('images/'.$item->produit->image)}}" alt="" srcset="">
                            <td>{{$item->produit->nom}}</td>
                            <td>{{$item->produit->prix}}</td>
                            <td><input type="number" name="" value="{{$item->quantite}}" id="" class="quantite-input" data-panier-item-id="{{$item->id}}"></td>
                            <td>{{$item->produit->prix * $item->quantite}}</td>
                            @php
                                $sous_total += $item->produit->prix * $item->quantite;
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>


    {{-- cart-add --}}

    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Appliquer un bon d'achat</h3>
            <div>
                <input type="text" placeholder="entrez le code ici">
                <button class="normal">Appliquer</button>
            </div>
        </div>
        <div id="subtotal">
            <h3>Totaux resumant de votre Achat</h3>
            <table>
                <tr>
                    <td class="sous-total">SousTotal Panier</td>
                    <td>{{ $sous_total }}</td>
                </tr>
                <tr>
                    <td>Expédition</td>
                    <td>Gratuit (0 XOF)</td>
                </tr>
                <tr>
                    <td colspan="6"><strong>Total</strong></td>
                    <td id="total"><strong>{{ $sous_total }} XOF</strong></td>
                </tr>
            </table>
            <button class="normal" id="valider-panier-btn">Valider le panier</button>
        </div>
    </section>
    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script>
var csrfToken = '{{ csrf_token() }}';
// Fonction pour mettre à jour la quantité d'un produit dans le panier
function updateQuantitePanier(panierItemId, quantite) {
    // Effectuer une requête AJAX pour mettre à jour la quantité du produit dans le panier
    $.ajax({
        url: '{{ route('panier.mettre-a-jour') }}',
        type: 'POST',
        dataType: 'json',
        data: {
            _token : csrfToken,
            panierItemId: panierItemId,
            quantite: quantite
        },
        success: function (response) {
            // Traiter la réponse de la requête AJAX
            if (response.success) {
                // Succès : mettre à jour les éléments de la ligne du panier et recalculer les totaux
                var lignePanier = $('#panier-item-' + panierItemId);
                lignePanier.find('.sous-total').text(response.sousTotal);
                location.reload();
            } else {
                // Erreur : afficher un message d'erreur ou effectuer toute autre action souhaitée
                console.error('Erreur lors de la mise à jour de la quantité du produit dans le panier');
            }
        },
        error: function (xhr, status, error) {
            // Erreur de la requête AJAX : afficher un message d'erreur ou effectuer toute autre action souhaitée
            console.log(xhr.responseText);
            console.log('Erreur AJAX : ' + error);
        }
    });
}

// Fonction pour supprimer un produit du panier
function supprimerProduitPanier(panierItemId) {
    // Effectuer une requête AJAX pour supprimer le produit du panier
    $.ajax({
        url: '{{ route('panier.supprimer') }}',
        type: 'POST',
        dataType: 'json',
        data: {
            _token: csrfToken,
            panierItemId: panierItemId
        },
        success: function (response) {
            // Traiter la réponse de la requête AJAX
            if (response.success) {
                // Succès : supprimer la ligne du panier et recalculer les totaux
                var lignePanier = $('#panier-item-' + panierItemId);
                lignePanier.remove();
                location.reload();
            } else {
                // Erreur : afficher un message d'erreur ou effectuer toute autre action souhaitée
                console.error('Erreur lors de la suppression du produit du panier');
            }
        },
        error: function (xhr, status, error) {
            // Erreur de la requête AJAX : afficher un message d'erreur ou effectuer toute autre action souhaitée
            location.reload();
            console.log('Erreur AJAX : ' + error);
        }
    });
}

// Gestionnaire d'événement pour la modification de la quantité d'un produit dans le panier
$(document).on('change', '.quantite-input', function () {
    var panierItemId = $(this).data('panier-item-id');
    var quantite = parseInt($(this).val());

    // Vérifier si la quantité est valide
    if (!isNaN(quantite) && quantite > 0) {
        updateQuantitePanier(panierItemId, quantite);
    } else {
        // Afficher un message d'erreur ou effectuer toute autre action souhaitée
        console.error('La quantité du produit est invalide');
    }
});

// Gestionnaire d'événement pour le clic sur le bouton de suppression d'un produit du panier
$(document).on('click', '.supprimer-produit', function () {
    var panierItemId = $(this).data('panier-item-id');
    supprimerProduitPanier(panierItemId);
});

$(document).ready(function() {
    // Lorsque le bouton "Valider le panier" est cliqué
    $('#valider-panier-btn').on('click', function() {
        // Récupérer le total du panier
        var sousTotal = parseInt($('#subtotal td:first-child').next().text());

        // Effectuer la requête AJAX vers le backend
        $.ajax({
            url: '/valider-panier',
            method: 'POST',
            data: {
                _token: csrfToken,
                sous_total: sousTotal
            },
            success: function(response) {
                // Afficher le message de succès
                console.log(response);
                showAlert('Panier validé avec succès', 'success');

                // Recharger la page après 3 secondes
                setTimeout(function() {
                    location.reload();
                }, 5000);
            },
            error: function(xhr, status, error) {
                // Afficher le message d'erreur
                console.log(xhr.responseText);
                showAlert('Une erreur est survenue lors de la validation du panier', 'error');
            }
        });
    });

    // Fonction pour afficher une alerte personnalisée
    function showAlert(message, type) {
        var alertClass = type === 'success' ? 'alert-success' : 'alert-error';
        var alertHtml = '<div class="alert ' + alertClass + '">';

            if (type === 'success') {
            // Ajouter un lien pour compléter le processus et payer
                alertHtml += message + ' <a href="{{url('/payement-details')}}">Cliquez ici</a> pour compléter le processus et payer.';
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

@extends('layouts.base-app')

@section('content')
  <!-- 
    - #ASIDE
  -->
  @include('layouts.agrotech-header')
  <aside class="aside">

    <div class="side-panel" data-side-panel="whishlist">

      <button class="panel-close-btn" aria-label="Close whishlist" data-panel-btn="whishlist">
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <ul class="panel-list">

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="./assets/images/product-small-1.jpg" width="46" height="46" loading="lazy"
                alt="Bright Side Vegetarian">
            </figure>

            <div>
              <p class="item-title">Bright Side Vegetarian</p>

              <span class="item-value">$20.15x1</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="./assets/images/product-small-2.jpg" width="46" height="46" loading="lazy" alt="Eco Vegetable">
            </figure>

            <div>
              <p class="item-title">Eco Vegetable</p>

              <span class="item-value">$13.25x2</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

        <li class="panel-item">
          <a href="./product-details.html" class="panel-card">

            <figure class="item-banner">
              <img src="./assets/images/product-small-3.jpg" width="46" height="46" loading="lazy"
                alt="House of Veggies">
            </figure>

            <div>
              <p class="item-title">House of Veggies</p>

              <span class="item-value">$20.15x1</span>
            </div>

            <button class="item-close-btn" aria-label="Remove item">
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </a>
        </li>

      </ul>

      <div class="subtotal">
        <p class="subtotal-text">Subtotal:</p>

        <data class="subtotal-value" value="215.14">$215.14</data>
      </div>

      <a href="./whishlist.html" class="panel-btn">View Whishlist</a>

    </div>

    <div class="side-panel" data-side-panel="cart">

      <button class="panel-close-btn" aria-label="Close cart" data-panel-btn="cart">
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <ul class="panel-list">

        @if (auth('particulier')->check())
            @if (!empty(auth('particulier')->user()->panier->panierItems))
            @foreach (auth('particulier')->user()->panier->panierItems as $panieritem)
              <li class="panel-item">
                <a href="{{url('/products/'.$panieritem->produit->id.'/details')}}" class="panel-card">
      
                  <figure class="item-banner">
                    <img src="{{asset('images/'.$panieritem->produit->image)}}" width="46" height="46" loading="lazy"
                      alt="Bright Side Vegetarian">
                  </figure>
      
                  <div>
                    <p class="item-title">{{ $panieritem->produit->nom }}</p>
      
                    <span class="item-value">{{$panieritem->produit->prix}}x{{ $panieritem->quantite }}</span>
                  </div>
      
                  <button class="item-close-btn" aria-label="Remove item">
                    <ion-icon name="close-outline"></ion-icon>
                  </button>
      
                </a>
              </li>
            @endforeach
            @endif
        @endif

      </ul>

      <div class="subtotal">
        <p class="subtotal-text">Subtotal:</p>

        <data class="subtotal-value" value="215.14">$215.14</data>
      </div>

      <a href="{{url('/mycart')}}" class="panel-btn">Mon Panier</a>

    </div>

  </aside>
  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <!-- 
        - #BREADCUMB
      -->

      <div class="breadcumb-wrapper">

        <h2 class="page-title">Marché</h2>
        <p>Lieu de rencontre des agriculteurs et des acheteurs. Venez trouver les produits frais</p>

        <ol class="breadcumb-list">

          <li class="breadcumb-item">
            <a href="{{url('/')}}" class="breadcumb-link">Home</a>
          </li>

          <li class="breadcumb-item">Espace Marché</li>

        </ol>

      </div>

      <!-- 
        - #OFFERS
      -->

      <section class="section offers">
        <div class="container">

          <ul class="offers-list has-scrollbar">

            <li class="offers-item">
              <a href="./shop.html" class="offers-card">

                <figure class="card-banner">
                  <img src="{{asset('images/undraw_season_change_f99v.svg')}}" width="292" height="230" loading="lazy"
                    alt="New Shp Season" class="w-100">
                </figure>

                <div class="card-content">
                  <p class="card-subtitle">Jusqu'à 25% de réduction</p>

                  <h3 class="h3 card-title">Nouvelle Saison de Ventes ouvert</h3>

                  <div class="btn btn-primary">Trouver un produit</div>
                </div>

              </a>
            </li>

            <li class="offers-item">
              <a href="./shop.html" class="offers-card">

                <figure class="card-banner">
                  <img src="{{asset('images/undraw_time_management_re_tk5w.svg')}}" width="336" height="244" loading="lazy"
                    alt="Healthy & fresh beef" class="w-100">
                </figure>

                <div class="card-content">
                  <p class="card-subtitle">Fini Bientot!</p>
                  <h3 class="h3 card-title">Temps restants</h3>
                  <div class="timer" id="countdown"></div>
                </div>

              </a>
            </li>

          </ul>

        </div>
      </section>
      <!-- 
        - #PRODUCT
      -->
      <section class="section product">
        <div class="container">

          <p class="section-subtitle"> -- Nos produits --</p>

          <h2 class="h2 section-title">Produits frais Sur notre MarketPlace</h2>

          <ul class="filter-list">

            <li>
              <button class="filter-btn active" data-tab="cereales">
                <img src="./assets/images/filter-1.png" width="20" alt="" class="default">

                <img src="./assets/images/filter-1-active.png" width="20" alt="" class="color">

                <p class="filter-text">Céréales</p>
              </button>
            </li>

            <li>
              <button class="filter-btn" data-tab="tubercules">
                <img src="./assets/images/filter-2.png" width="20" alt="" class="default">

                <img src="./assets/images/filter-2-active.png" width="20" alt="" class="color">

                <p class="filter-text">Tubercules</p>
              </button>
            </li>

            <li>
              <button class="filter-btn" data-tab="fruits">
                <img src="./assets/images/filter-3.png" width="20" alt="" class="default">

                <img src="./assets/images/filter-3-active.png" width="20" alt="" class="color">

                <p class="filter-text">Fruits & Légumes</p>
              </button>
            </li>

            <li>
              <button class="filter-btn" data-tab="oleagineux">
                <img src="./assets/images/filter-1.png" width="20" alt="" class="default">

                <img src="./assets/images/filter-1-active.png" width="20" alt="" class="color">

                <p class="filter-text">Oléagineux</p>
              </button>
            </li>

          </ul>

          <ul class="grid-list">
          {{-- Cereales Products --}}
            @if (count($cereales))
              
            @foreach ($cereales as $cereale)
            <li class="product-item cereales active">
                <div class="product-card">

                  <figure class="card-banner">
                    <img src="{{ asset('images/'.$cereale->image) }}" width="189" height="189" loading="lazy"
                      alt="Fresh Watermelon">

                    <div class="btn-wrapper">
                      <button class="product-btn" aria-label="Add to Whishlist">
                        <ion-icon name="heart-outline"></ion-icon>

                        <div class="tooltip">Ajouter à mes favoris</div>
                      </button>

                      <button class="product-btn" aria-label="Quick View">
                        <ion-icon name="eye-outline"></ion-icon>

                        <div class="tooltip">Vue Rapide</div>
                      </button>
                    </div>
                  </figure>

                  <div class="rating-wrapper">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <h3 class="h4 card-title">
                    <a href="{{ url('/products/'.$cereale->id .'/details') }}">{{ $cereale->nom }}</a>
                  </h3>

                  <div class="price-wrapper">
                    {{-- <del class="del">$75.00</del> --}}

                    <data class="price" value="{{$cereale->prix}}">{{ $cereale->prix }} CFA</data> <br>
                    <data class="quantite_disponible" value="{{$cereale->poids_base}}">Quantité disponible: {{$cereale->poids_base}}</data> <br> <br>
                    <data class="type_vente">Le produit se vend par: <strong>{{$cereale->type_vente}}</strong></data>

                  </div>

                  <button class="btn btn-primary add-to-cart" data-product-id="{{ $cereale->id }}">Ajouter au panier</button>

                </div>
            </li>
            @endforeach
            @endif
            {{-- Tubercules Products --}}
            @if (isset($tubercules))
             
            @foreach ($tubercules as $tubercule)
            <li class="product-item tubercules">
              <!-- Produits de type "Tubercules" -->
                <div class="product-card">

                  <figure class="card-banner">
                    <img src="{{ asset('images/'.$tubercule->image) }}" width="189" height="189" loading="lazy"
                      alt="Fresh Watermelon">

                    <div class="btn-wrapper">
                      <button class="product-btn" aria-label="Add to Whishlist">
                        <ion-icon name="heart-outline"></ion-icon>

                        <div class="tooltip">Ajouter à mes favoris</div>
                      </button>

                      <button class="product-btn" aria-label="Quick View">
                        <ion-icon name="eye-outline"></ion-icon>

                        <div class="tooltip">Vue rapide</div>
                      </button>
                    </div>
                  </figure>

                  <div class="rating-wrapper">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <h3 class="h4 card-title">
                    <a href="{{ url('/products/' . $tubercule->id . '/details') }}">{{ $tubercule->nom }}</a>
                  </h3>

                  <div class="price-wrapper">
                    {{-- <del class="del">$75.00</del> --}}

                    <data class="price" value="{{$tubercule->prix}}">{{$tubercule->prix}} CFA</data>
                    <data class="quantite_disponible" value="{{$tubercule->poids_base}}">Quantité disponible: {{$tubercule->poids_base}}</data> <br> <br>
                    <data class="type_vente">Le produit se vend par: <strong>{{$tubercule->type_vente}}</strong></data>
                  </div>

                  <button class="btn btn-primary add-to-cart" data-product-id="{{ $tubercule->id }}">Ajouter au panier</button>

                </div>
            </li>
            @endforeach
            @endif
            {{-- Fruits & Légumes products --}}
            @if (isset($fruits))
             
            @foreach ($fruits as $fruit)
            <li class="product-item fruits">
             
                <div class="product-card">

                  <figure class="card-banner">
                    <img src="{{ asset('images/'.$fruit->image) }}" width="189" height="189" loading="lazy" alt="Visual matches">

                    <div class="btn-wrapper">
                      <button class="product-btn" aria-label="Add to Whishlist">
                        <ion-icon name="heart-outline"></ion-icon>

                        <div class="tooltip">Ajouter à mes favoris</div>
                      </button>

                      <button class="product-btn" aria-label="Quick View">
                        <ion-icon name="eye-outline"></ion-icon>

                        <div class="tooltip">Vue rapide</div>
                      </button>
                    </div>
                  </figure>

                  <div class="rating-wrapper">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <h3 class="h4 card-title">
                    <a href="{{ url('/product/' . $fruit->id . '/details') }}">{{ $fruit->nom }}</a>
                  </h3>

                  <div class="price-wrapper">
                    {{-- <del class="del">$75.00</del> --}}

                    <data class="price" value="{{$fruit->prix}}">{{$fruit->prix}} CFA</data> <br>
                    <data class="quantite_disponible" value="{{$fruit->poids_base}}">Quantité disponible: {{$fruit->poids_base}}</data> <br> <br>
                    <data class="type_vente">Le produit se vend par: <strong>{{$fruit->type_vente}}</strong></data>
                  </div>

                  <button class="btn btn-primary add-to-cart" data-product-id="{{ $fruit->id }}">Ajouter au panier</button>

                </div>
            </li>
            @endforeach
            @endif
            {{-- Oleagineux products --}}

            @if (isset($oleagineux))
              
                @foreach ($oleagineux as $oleagineu)
                  <li class="product-item oleagineux">
                    <!-- Produits de type "Oléagineux" -->
                    <div class="product-card">

                      <figure class="card-banner">
                        <img src="{{ asset('images/'.$oleagineu->image) }}" width="189" height="189" loading="lazy" alt="Visual matches">
    
                        <div class="btn-wrapper">
                          <button class="product-btn" aria-label="Add to Whishlist">
                            <ion-icon name="heart-outline"></ion-icon>
    
                            <div class="tooltip">Ajouter aux favoris</div>
                          </button>
    
                          <button class="product-btn" aria-label="Quick View">
                            <ion-icon name="eye-outline"></ion-icon>
    
                            <div class="tooltip">Vue rapide</div>
                          </button>
                        </div>
                      </figure>
    
                      <div class="rating-wrapper">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                      </div>
    
                      <h3 class="h4 card-title">
                        <a href="{{ url('/product/' . $oleagineu->id . '/details') }}">{{ $oleagineu->nom }}</a>
                      </h3>
    
                      <div class="price-wrapper">
                        {{-- <del class="del">$75.00</del> --}}
    
                        <data class="price" value="{{$oleagineu->prix}}">{{$oleagineu->prix}} CFA</data>
                        <data class="quantite_disponible" value="{{$oleagineu->poids_base}}">Quantité disponible: {{$oleagineu->poids_base}}</data> <br> <br>
                        <data class="type_vente">Le produit se vend par: <strong>{{ $oleagineu->type_vente }}</strong></data>
                      </div>
    
                      <button class="btn btn-primary add-to-cart" data-product-id="{{ $oleagineu->id }}">Ajouter au panier</button>
    
                    </div>
                  </li>
                @endforeach
            @endif
          </ul>
        </div>
      </section>

      {{-- Section Populary Products --}}
      <section class="section top-product">
        <div class="container">

          <p class="section-subtitle"> -- Populaires --</p>

          <h2 class="h2 section-title">Produits Agricocles Populaires</h2>

          <ul class="top-product-list grid-list">
            @foreach ($trendings as $trending)
              <li class="top-product-item">
                <div class="product-card top-product-card">

                  <figure class="card-banner">
                    <img src="{{ asset('images/'.$trending->image) }}" width="100" height="100" loading="lazy"
                      alt="Fresh Orangey">

                    <div class="btn-wrapper">
                      <button class="product-btn" aria-label="Add to Whishlist">
                        <ion-icon name="heart-outline"></ion-icon>

                        <div class="tooltip">Ajouter aux favoris</div>
                      </button>

                      <button class="product-btn" aria-label="Quick View">
                        <ion-icon name="eye-outline"></ion-icon>

                        <div class="tooltip">Vue Rapide</div>
                      </button>
                    </div>
                  </figure>

                  <div class="card-content">

                    <div class="rating-wrapper">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div>

                    <h3 class="h4 card-title">
                      <a href="{{ url('/products/'.$trending->id.'/details') }}">{{$trending->nom}}</a>
                    </h3>

                    <div class="price-wrapper">
                      {{-- <del class="del">$75.00</del> --}}

                      <data class="price" value="{{$trending->prix}}">{{$trending->prix}}</data>
                    </div>

                    <button class="btn btn-primary">Ajouter au panier</button>

                  </div>

                </div>
              </li>   
            @endforeach
          </ul>

        </div>
      </section>
  </main>
  <!-- 
    - #BACK TO TOP
  -->
  <a href="#top" class="back-to-top" aria-label="Back to Top" data-back-top-btn>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Récupérer dynamiquement le nombre de jours
    var jours = <?php echo isset($duree) ? $duree : 0; ?>;

    // Calculer la date de fin en ajoutant le nombre de jours à la date actuelle
    var dateActuelle = new Date();
    var dateFin = new Date(dateActuelle.getTime() + jours * 24 * 60 * 60 * 1000);
    dateFin.setHours(0, 0, 0, 0);

    // Mettre à jour le compte à rebours toutes les secondes
    var countdown = setInterval(function() {
        // Obtenir la date et l'heure actuelles
        var now = new Date().getTime();

        // Calculer la différence entre la date de fin et la date actuelle
        var distance = dateFin.getTime() - now;

        // Vérifier si le décompte est terminé
        if (distance < 0) {
            clearInterval(countdown);
            document.getElementById("countdown").innerHTML = "EXPIRÉ";
            return;
        }

        // Calculer les jours, heures, minutes et secondes restantes
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Afficher le temps restant dans la div
        document.getElementById("countdown").innerHTML = days + "j " + hours + "h " + minutes + "m " + seconds + "s ";
    }, 1000); // Répéter toutes les secondes (1000 ms)

    // Écouteurs d'événements pour les boutons de filtrage
  var filterButtons = document.querySelectorAll('.filter-btn');
  filterButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var selectedTab = this.getAttribute('data-tab');

      // Masquer tous les produits
      var productItems = document.querySelectorAll('.product-item');
      productItems.forEach(function (item) {
        item.style.display = 'none';
      });

      // Afficher uniquement les produits du type sélectionné
      var selectedItems = document.querySelectorAll('.' + selectedTab);
      selectedItems.forEach(function (item) {
        item.style.display = 'block';
      });

      // Définir le bouton actif
      filterButtons.forEach(function (btn) {
        btn.classList.remove('active');
      });
      this.classList.add('active');
    });
  });

  // Afficher uniquement les produits du tab actif au chargement de la page
  var activeButton = document.querySelector('.filter-btn.active');
  var activeTab = activeButton.getAttribute('data-tab');
  var activeItems = document.querySelectorAll('.' + activeTab);
  activeItems.forEach(function (item) {
    item.style.display = 'block';
  });
    // Fonction pour ajouter un produit au panier
    function ajouterAuPanier(productId, quantity = 1) {
        // Effectuer une requête AJAX pour ajouter le produit au panier
        var csrfToken = '{{ csrf_token() }}';
        $.ajax({
            url: '{{ route('panier.ajouter') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: csrfToken, // Ajouter le jeton CSRF à la requête
                productId: productId,
                quantity: quantity
            },
            success: function (response) {
                // Traiter la réponse de la requête AJAX
                if (response.success) {
                    // Succès : afficher un message, mettre à jour le panier ou effectuer toute autre action souhaitée
                    console.log('Produit ajouté au panier avec succès');
                } else {
                    // Erreur : afficher un message d'erreur ou effectuer toute autre action souhaitée
                    console.error('Erreur lors de l\'ajout du produit au panier');
                }
            },
            error: function (xhr, status, error) {
                // Erreur de la requête AJAX : afficher un message d'erreur ou effectuer toute autre action souhaitée
                console.log(xhr.responseText);
                // console.log('Erreur AJAX : ' + error);
            }
        });
    }

    // Gestionnaire d'événement pour le clic sur le bouton "Ajouter au panier"
    $('.add-to-cart').on('click', function () {
        var productId = $(this).data('product-id');
        ajouterAuPanier(productId);
    });

    // Gestionnaire d'événement pour le clic sur le bouton "Quick View"
    $('.quick-view').on('click', function () {
        var productId = $(this).data('product-id');
        // Effectuer toute autre action souhaitée pour afficher rapidement les détails du produit
        console.log('Affichage rapide du produit avec ID : ' + productId);
    });

    // Gestionnaire d'événement pour le clic sur le bouton "Add to Wishlist"
    $('.add-to-wishlist').on('click', function () {
        var productId = $(this).data('product-id');
        // Effectuer toute autre action souhaitée pour ajouter le produit à la liste de souhaits
        console.log('Produit ajouté à la liste de souhaits avec ID : ' + productId);
    });
</script>
@endsection
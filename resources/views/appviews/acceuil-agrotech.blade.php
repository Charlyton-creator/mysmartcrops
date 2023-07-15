@extends('layouts.base-app')
@section('content')
  <!-- 
    - #ASIDE
  -->
  @include('layouts.header')
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

      </ul>

      <div class="subtotal">
        <p class="subtotal-text">Subtotal:</p>

        <data class="subtotal-value" value="215.14">$215.14</data>
      </div>

      <a href="./cart.html" class="panel-btn">View Cart</a>

    </div>

  </aside>

  <main>
    <article>

      <!-- 
        - #HERO
      -->
      <section class="hero">
        <div class="container">

          <div class="hero-content">
            <div class="bubbles-container">
                <div class="bubble"></div>
                <div class="bubble"></div>
            </div>

            <p class="hero-subtitle"></p>

            <h2 class="h1 hero-title">
              MySmartCrops L'agriculture Autrement <span class="span"></span>
                <span class="span">Investissements - Marché - Conseils - Données Météos</span>
            </h2>

            <p class="hero-text">
                Transformez votre activité agricole avec MySmartCrops. 
                Maximisez vos rendements, optimisez vos ressources et découvrez de nouvelles opportunités grâce à notre plateforme innovante.
            </p>

          </div>

          <figure class="hero-banner">
            <img src="{{asset('images/hero-banner.png')}}" width="603" height="634" loading="lazy" alt="Vegetables"
              class="w-100">
          </figure>

        </div>
      </section>
      <!-- 
        - #SERVICE
      -->
      <section class="section service">
        <div class="container">
            <div class="section-title">
                <h2>Nos fonctionnalités</h2>
              </div>
            <div class="row">
                <div class="col-md-4">
                  <div class="feature-block">
                    <ion-icon name="bookmarks-outline" class="icon"></ion-icon>
                    <p>Gestion intelligente des cultures</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="feature-block">
                    <ion-icon name="analytics-outline" class="icon"></ion-icon>
                    <p>Analyse des données agricoles</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="feature-block">
                    <ion-icon name="construct-outline" class="icon"></ion-icon>
                    <p>Outils de planification agricole</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="feature-block">
                    <ion-icon name="information-outline" class="icon"></ion-icon>
                    <p>Conseils Agricoles pour la protection des cultures</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="feature-block">
                    <ion-icon name="cash-outline" class="icon"></ion-icon>
                    <p>Espace Marché</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="feature-block">
                    <ion-icon name="people-outline" class="icon"></ion-icon>
                    <p>Collaboration entre agriculteurs</p>
                  </div>
                </div>
            </div>
        </div>
      </section>

      <section class="cta how-it-works-section mb-5">
        <div class="container">

          <p class="section-subtitle">Choississez votre profil</p>

          <h2 class="h2 section-title">Choisissez le compte qui correspond à vos besoins</h2>
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#agriculteur-tab">Agriculteur / Jardinier</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#particulier-tab">Particulier</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#investisseur-tab">Investisseur</a>
            </li>
          </li>
          </ul>
      
          <div class="tab-content">
            <div class="tab-pane fade show active" id="agriculteur-tab">
              <h3>Compte Agriculteur</h3>
              <p>En tant qu'agriculteur ou jardinier, notre plateforme vous offre une multitude de fonctionnalités puissantes pour faciliter la gestion de vos cultures et optimiser vos activités agricoles. 
                Avec notre plateforme conviviale et notre engagement envers l'innovation technologique, nous sommes là pour soutenir votre succès.
                Entre autres nous vous offrons:
                <ul class="feature-list">
                  <li>
                   
                    <label for="feature1">Gestion de votre AgroEspace</label>
                  </li>
                  <li>
                    
                    <label for="feature2">Vente en ligne de produits</label>
                  </li>
                  <li>
                    
                    <label for="feature3">Informations météorologiques en temps réel</label>
                  </li>
                  <li>
                    
                    <label for="feature4">Conseils agricoles personnalisés</label>
                  </li>
                </ul>          
              </p>
              <div class="d-flex justify-content-between mr-1">
                <a href="{{url('/comptes/agriculteur')}}" class="btn btn-primary">Creer mon Compte</a> 
                <a href="{{url('/comptes/agriculteur')}}" class="btn btn-primary">Me Connecter</a>
              </div>
              {{-- <a href="{{url('/comptes/agriculteur')}}" class="btn btn-primary">Creer mon Compte</a> --}}
            </div>
            <div class="tab-pane fade" id="particulier-tab">
              <h3>Compte Particulier</h3>
              <p>En tant que particulier, notre plateforme vous offre des fonctionnalités pratiques pour vous connecter directement avec les agriculteurs locaux et accéder à des produits frais et de qualité. 
                Nous vous permettons de profiter de l'agriculture de proximité tout en facilitant vos achats en ligne.
                Entre autres nous vous offrons:
                <ul class="feature-list">
                  <li>
                    <label for="feature1">Recherche de produits agricoles</label>
                  </li>
                  <li>
                    <label for="feature2">Achat en ligne facile</label>
                  </li>
                  <li>
                    <label for="feature3">Suivi des commandes</label>
                  </li>
                  <li>
                    <label for="feature4">Évaluations et commentaires</label>
                  </li>
                </ul>          
              </p>
              <div class="d-flex justify-content-between mr-1">
                <a href="{{url('/comptes/particulier')}}" class="btn btn-primary">Creer mon Compte</a> 
                <a href="{{url('/comptes/particulier')}}" class="btn btn-primary">Me Connecter</a>
              </div>
            </div>
            <div class="tab-pane fade" id="investisseur-tab">
              <h3>Compte Investisseur</h3>
              <p>
                En tant qu'investisseur, notre plateforme vous offre des opportunités uniques dans le secteur agricole. 
                Nous vous permettons de découvrir et d'investir dans des projets agricoles prometteurs, tout en offrant des fonctionnalités spécifiques pour suivre et gérer vos investissements.
                Entre autres nous vous offrons:
      
                <ul class="feature-list">
                  <li>
                    <label for="feature1">Exploration de projets agricoles</label>
                  </li>
                  <li>
                    <label for="feature2">Investissements ciblés</label>
                  </li>
                  <li>
                    <label for="feature3">Suivi et gestion des investissements</label>
                  </li>
                  <li>
                    <label for="feature4">Communauté d'investisseurs</label>
                  </li>
                </ul>          
              </p>
              <div class="d-flex justify-content-between mr-1">
                <a href="{{url('/comptes/investisseur')}}" class="btn btn-primary">Creer mon Compte</a> 
                <a href="{{url('/comptes/investisseur')}}" class="btn btn-primary">Me Connecter</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 
        - #TOP PRODUCT
      -->

      <section class="section top-product">
        <div class="container">

          <p class="section-subtitle"> -- Produits frais --</p>

          <h2 class="h2 section-title">Découvrez nos derniers produits</h2>

          <ul class="top-product-list grid-list">

            @if(empty($produits))
              <div class="information-alert">
                <p>Nous n'avons malheureusement pas de nouveau produits soit notre saison de vente est expirée veuillez revenir plus tard. </p>
              </div>
            @else
              @foreach($produits as $produit)
                <li class="top-product-item">
                  <div class="product-card top-product-card">
    
                    <figure class="card-banner">
                      <img src="{{ asset('images/'.$produit->image) }}" width="100" height="100" loading="lazy"
                      alt="Image de produit">
    
                      <div class="btn-wrapper">
                        <button class="product-btn" aria-label="Add to Whishlist">
                          <ion-icon name="heart-outline"></ion-icon>
    
                          <div class="tooltip">Ajouter aux favoris</div>
                        </button>
    
                        <button class="product-btn" aria-label="Quick View">
                          <ion-icon name="eye-outline"></ion-icon>
    
                          <div class="tooltip">Vue</div>
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
                        <a href="{{ url('/products/'.$produit->id.'/details') }}">{{$produit->nom}}</a>
                      </h3>
  
                      <div class="price-wrapper">
                        {{-- <del class="del">$75.00</del> --}}
  
                        <data class="price" value="{{$produit->prix}}">{{$produit->prix}}</data>
                      </div>
  
                      <button class="btn btn-primary add-to-cart" data-product-id="{{ $produit->id }}">Ajouter au panier</button>
    
                    </div>
    
                  </div>
                </li>
              @endforeach
            @endif
          </ul>

        </div>
      </section>

      <!-- 
        - #PARTNER
      -->

      <section class="section partner">
        <div class="container">

          <p class="section-subtitle"> -- A propos MySmartCrops --</p>

          <h2 class="h2 section-title">Agro Technologies</h2>

          <div class="row">
            <div class="col-md-6">
              <div class="left-content">
                <h3>L'Agro Technologie au service de l'agriculture moderne</h3>
                <p>MySmartCrops est une plateforme innovante qui vise à révolutionner l'industrie agricole en utilisant les dernières avancées technologiques. 
                    Notre objectif est de fournir aux agriculteurs, aux investisseurs et aux particuliers les outils et les ressources nécessaires pour optimiser leur rendement, stimuler la croissance économique et promouvoir un développement durable.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="right-content">
                <img src="{{asset('images/undraw_environment_iaus.svg')}}" alt="Image" class="mr-5">
                </div>
                <style>
                    .right-content img {
                        max-width: 100%;
                        height: auto;
                        margin-rigth: 5px;
                    }

                </style>
            </div>
          </div>
        </div>

      </section>
      <!-- 
        - #TESTIMONIALS
      -->

      <!-- 
        - #BLOG
      -->

      <section class="section blog">
        <div class="container">

          <p class="section-subtitle"> -- Projets --</p>

          <h2 class="h2 section-title">Projets innovants à la recherche d'investisseurs</h2>

          <ul class="blog-list">
            @if(count($projets)== 0 )
              <div class="information-alert">
                <p>Nous n'avons malheureusement pas de nouveau Projet sur notre Plateforme. Vous recherchez des projets innovants? visitez nous plus tard! </p>
              </div>
            @else
            @foreach($projets as $projet)
              <li>
                <div class="blog-card">

                  <figure class="card-banner">
                    <img src="./assets/images/blog-1.jpg" width="451" height="310" loading="lazy"
                      alt="We automatically search for andapply coupons when." class="w-100">
                  </figure>

                  <div class="card-content">

                    <div class="card-wrapper">

                      <div class="wrapper-item">
                        <ion-icon name="calendar-clear-outline"></ion-icon>

                        <time class="text" datetime="2022-04-13">13 April, 2022</time>
                      </div>

                      <div class="wrapper-item">
                        <ion-icon name="heart-outline"></ion-icon>

                        <span class="text">58 Million</span>
                      </div>

                    </div>

                    <h3 class="h3 card-title">
                      <a href="./404.html">We automatically search for andapply coupons when.</a>
                    </h3>

                    <a href="./404.html" class="btn btn-primary">
                      <span>Read More</span>

                      <ion-icon name="chevron-forward" aria-hidden="true"></ion-icon>
                    </a>

                  </div>

                </div>
              </li>
            @endforeach
            @endif
          </ul>
        </div>
      </section>

      <!-- 
        - #NEWSLETTER
      -->
    </article>
  </main>
  <a href="#top" class="back-to-top" aria-label="Back to Top" data-back-top-btn>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.nav-tabs .nav-link').on('click', function() {
    $('.nav-tabs .nav-link').removeClass('active');
    $(this).addClass('active');
    
    var tabId = $(this).attr('href');
    $('.tab-pane').removeClass('show active');
    $(tabId).addClass('show active');
    });
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
</script>
@endsection
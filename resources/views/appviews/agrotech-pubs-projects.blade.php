
@extends('layouts.base-app')
@section('content')
  @include('layouts.header')
  <link rel="stylesheet" href="{{asset('css/shop.css')}}">
  <main class="content-wrapper">
    <article>
      <div class="breadcumb-wrapper">

        <h2 class="page-title">Projets & Publicités</h2>
        <p>Découvrez les projets publiés par les agriculteurs <br>
            trouvez des opportunités d'investissement et explorez les dernières innovations dans le domaine agricole.</p>

        <ol class="breadcumb-list">

          <li class="breadcumb-item">
            <a href="{{url('/')}}" class="breadcumb-link">Home</a>
          </li>

          <li class="breadcumb-item">projets-publicités</li>

        </ol>

      </div>

      <!-- 
        - #PRODUCT
      -->
      <section class="section blog">
        <div class="container">
          <p class="section-subtitle"> -- Projets --</p>

          <h2 class="h2 section-title">Projets innovants à la recherche d'investisseurs</h2>

          <ul class="blog-list">
            @if(count($projets) == 0)
              <div class="information-alert">
                <p>Aucun Projet sur MySmartCrops actuellement. Revenez Plus tard</p>
              </div>
            @else
            @foreach ($projets as $projet)
              <li>
                <div class="blog-card">
                  <div class="card-content">
  
                    <div class="card-wrapper">
  
                      <div class="wrapper-item">
                        <ion-icon name="calendar-clear-outline"></ion-icon>
  
                        <time class="text" datetime="{{$projet->created_at}}">{{$projet->created_at}}</time>
                      </div>
  
                      <div class="wrapper-item">
                        <ion-icon name="logo-usd"></ion-icon>
  
                        <span class="text">{{$projet->valeur_investissement_attendu}}</span>
                      </div>
  
                    </div>
  
                    <h3 class="h3 card-title">
                      <a href="{{asset('documents/'.$projet->document_descriptif)}}">Document Projet</a>
                    </h3>
                     Description : <p>{{$projet->description}}</p>
                    <button class="btn btn-primary open-subscribe-form"><span>Investir maintenant</span></button>
                  </div>
                </div>
              </li>  
            @endforeach
            @endif
          </ul>
        </div>
      </section>
      
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var contentWrapper = document.querySelector('.content-wrapper');
      const openSubscribeFormBtns = document.querySelectorAll('.open-subscribe-form');
      const closeBtn = document.querySelector('.close-btn');
      const subscribeForm = document.querySelector('.subscribe-form');

      openSubscribeFormBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
          subscribeForm.classList.add('active');
          contentWrapper.classList.add('popup-active');
        });
      });

      closeBtn.addEventListener('click', function() {
        subscribeForm.classList.remove('active');
        contentWrapper.classList.remove('popup-active');
      });
    });

  </script>
      <section class="section top-product">
        <div class="container">
         <p class="section-subtitle"> -- Publicités de produits --</p>

          <h2 class="h2 section-title">Les Meilleurs produits Bio pour vous</h2>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-6">
                        <!-- Première carte -->
                        <div class="carousel-card">
                                <img src="{{asset('images/blog-1.jpg')}}" alt="Image 2">
                                <div class="carousel-card-overlay">
                                <h3 class="carousel-card-title">Titre de la carte 2</h3>
                                <p class="carousel-card-description">Description de la carte 2</p>
                                <a href="#" class="btn btn-primary">Details</a>
                                <a href="#" class="btn btn-success">Ajouter au panier</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="carousel-card">
                                <img src="{{asset('images/blog-1.jpg')}}" alt="Image 2">
                                <div class="carousel-card-overlay">
                                <h3 class="carousel-card-title">Titre de la carte 2</h3>
                                <p class="carousel-card-description">Description de la carte 2</p>
                                    <a href="#" class="btn btn-primary">Details</a>
                                    <a href="#" class="btn btn-success">Ajouter au panier</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-6">
                        <!-- Première carte -->
                        <div class="carousel-card">
                                <img src="{{asset('images/blog-1.jpg')}}" alt="Image 2">
                                <div class="carousel-card-overlay">
                                <h3 class="carousel-card-title">Titre de la carte 2</h3>
                                <p class="carousel-card-description">Description de la carte 2</p>
                                <a href="#" class="btn btn-primary">Details</a>
                                <a href="#" class="btn btn-success">Ajouter au panier</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="carousel-card">
                                <img src="{{asset('images/blog-1.jpg')}}" alt="Image 2">
                                <div class="carousel-card-overlay">
                                <h3 class="carousel-card-title">Titre de la carte 2</h3>
                                <p class="carousel-card-description">Description de la carte 2</p>
                                <a href="#" class="btn btn-primary">Details</a>
                                <a href="#" class="btn btn-success">Ajouter au panier</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>     
  </main>
  <div class="subscribe-form">
    <div class="left">
      <img src="{{asset('images/undraw_Investment_re_rpk5.png')}}" alt="" width="100%"/>
    </div>
    <div class="right">
      <h2>Confirmer votre desir d'investir</h2>
      <p>Veuillez renseigner les informations pour confirmer votre desir d'investir dans ce projet. Ces informations sont 100% protégés et nous permettrons juste de pouvoir prendre attache avec vous.</p>
      <div class="form">
        <form>
          <div class="input">
            <label for="email_confirmation">Confirmer votre email</label>
            <input type="email" name="email" id="email">
          </div>
          <div class="input">
            <label for="phone_confirmation">Renseignez votre numéro de téléphone</label>
            <input type="text" name="phone_number" id="phone_number">
          </div>
          <div class="button">
            <button>Confirmer</button>
          </div>
        </form>
      </div>
      <button class="close-btn">&times;</button>
    </div>
  </div>
  <a href="#top" class="back-to-top" aria-label="Back to Top" data-back-top-btn>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$('#carouselExample').carousel({
  interval: 3000, // Intervalles de 3 secondes
  wrap: true, // Boucler le carrousel
  slidesToShow: 2 // Faire défiler 3 cartes à la fois
});
// Défilement automatique du carrouse
</script>
@endsection
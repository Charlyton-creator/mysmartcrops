
@extends('layouts.base-app')

@section('content')
  @include('layouts.header')
  <link rel="stylesheet" href="{{asset('css/shop.css')}}">
  <main>
    <article>

      <div class="breadcumb-wrapper">

        <h2 class="page-title">Conseils Agricoles Experts et Offres d'Abonnements</h2>
        <p>Boostez vos récoltes et développez votre activité agricole avec nos conseils d'experts. 
            Découvrez nos offres d'abonnements adaptées aux besoins des agriculteurs passionnés</p>

        <ol class="breadcumb-list">

          <li class="breadcumb-item">
            <a href="{{url('/')}}" class="breadcumb-link">Home</a>
          </li>

          <li class="breadcumb-item">conseils-offres</li>

        </ol>

      </div>

      <!-- 
        - #PRODUCT
      -->

      <section class="section product">
        <div class="container">

          <p class="section-subtitle"> -- Conseils d'experts --</p>

          <h2 class="h2 section-title">Conseils Agricoles d'Experts</h2>
          <section class="conseils">
            @if(empty($conseils))
              <div class="empty">
                <p>Aucun Conseil enregisté au jour d'aujourd'hui. Veuillez refaire un tour plus tard. </p>
              </div>
            @endif
            @foreach ($conseils as $conseil)
              <div class="carte">
                <div class="icone-expert">
                  <img src="{{asset('images/'.$conseil->image_auteur)}}" alt="Icone Expert">
                </div>
                <p>{{ $conseil->texte }}</p>
                <a href="{{$conseil->source_url}}" class="boutton-lire">Lire la suite</a>
              </div>  
            @endforeach
          </section>          
        </div>
      </section>

      {{-- Section Populary Products --}}
      <section class="section top-product">
        <div class="container">

          <p class="section-subtitle"> -- Offres --</p>

          <h2 class="h2 section-title">Boostez votre Expérience sur AgroTech</h2>

          <ul class="top-product-list grid-list">
            @if(empty($offres))
             <div class="empty">
              <p>Aucune Offre n'est disponible actuellement. Veuillez revenir plus tard.</p>
             </div>
            @endif
            @foreach ($offres as $offre)
            <div class="offer-card">
              @if($offre->code == "VB")
              <div class="recommended-badge">Recommandé</div>
              @endif
                 <div class="offer-icon  blue-bg">
                 <span>{{ $offre->code  }}</span>
                 </div>
                 <div class="offer-price">
                     <div class="offer-price-inner">
                       {{$offre->prix}}CFA/M <!-- Remplacez "10.000 CFA" par le prix de l'offre -->
                     </div>
                 </div>
                   
                 <h3 class="offer-title">{{$offre->designation}}</h3>
                 <ul class="offer-advantages">
                  @foreach ($offre->avantages as $avantage)
                    <li><i class="bx bx-check"></i>{{$avantage->libelle}}</li>
                  @endforeach
                 </ul>
                 <p class="text-muted p-2">{{ $offre->description }}</p>
                 <a href="#" class="offer-button green-bg">Souscrire</a>
            </div>
            @endforeach

        </div>
      </section>
  </main>
  <!-- 
    - #BACK TO TOP
  -->
  <a href="#top" class="back-to-top" aria-label="Back to Top" data-back-top-btn>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>
  <script>

  </script>
@endsection
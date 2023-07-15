  <!-- 
    - #HEADER
  -->
  <header class="header" data-header>

    <div class="top-bar">
      <div class="container">
        <p>Inscrivez vous aujourd'hui et gagner un cadeau!</p>
      </div>
    </div>

    <div class="nav-wrapper">
      <div class="container">

          <img src="{{asset('images/MSC.png')}}" alt="logo" srcset="" style="background: transparent; width:8%;" >
        <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
          <ion-icon name="menu-outline"></ion-icon>
        </button>

        <nav class="navbar" data-navbar>

          <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

          <ul class="navbar-list">

            <li>
              <a href="{{url('/')}}" class="navbar-link">Acceuil</a>
            </li>
            
            <li>
              <a href="{{url('/espace-marche')}}" class="navbar-link">Espace Marché</a>
            </li>

            <li>
              <a href="{{url('/espace-conseils')}}" class="navbar-link">Conseils Agricoles</a>
            </li>

            <li>
              <a href="{{url('/projets-pubs')}}" class="navbar-link">Projets - Publicités</a>
            </li>

            <li>
              <a href="#" class="navbar-link">A Propos</a>
            </li>
          </ul>

        </nav>

        <div class="header-action">

          <div class="search-wrapper" data-search-wrapper>

            <button class="header-action-btn" aria-label="Toggle search" data-search-btn>
              <ion-icon name="search-outline" class="search-icon"></ion-icon>
              <ion-icon name="close-outline" class="close-icon"></ion-icon>
            </button>

            <div class="input-wrapper">
              <input type="search" name="search" placeholder="Search here" class="search-input">

              <button class="search-submit" aria-label="Submit search">
                <ion-icon name="search-outline"></ion-icon>
              </button>
            </div>

          </div>
          @if (auth('particulier')->check())
            <button class="header-action-btn" aria-label="Open whishlist" data-panel-btn="whishlist">
              <ion-icon name="heart-outline"></ion-icon>

              <data class="btn-badge" value="3">03</data>
            </button>

            <button class="header-action-btn" aria-label="Open shopping cart" data-panel-btn="cart">
              <ion-icon name="basket-outline"></ion-icon>

              <data class="btn-badge" value="2">{{!empty(auth('particulier')->user()->panier->panierItems) ? count(auth('particulier')->user()->panier->panierItems) : 0 }}</data>
            </button>
          @endif
        </div>

      </div>
    </div>
</header>
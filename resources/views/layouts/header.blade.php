  <!-- 
    - #HEADER
  -->
<header class="header" data-header>

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
              <a href="{{url('/espace-conseils')}}" class="navbar-link">Conseils & Offres</a>
            </li>

            <li>
              <a href="{{url('/projets-pubs')}}" class="navbar-link">Projets - Publicités</a>
            </li>

            <li>
              <a href="#" class="navbar-link">A Propos</a>
            </li>
          </ul>

        </nav>
    </div>
</header>
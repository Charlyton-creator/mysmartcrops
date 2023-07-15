<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{asset('css/comptes.css')}}" />
    <title>AgroTech - Profils</title>
  </head>
  <body>
    <div class="container">
      <div class="custom-popup" id="success-popup">
        <div class="popup-content success-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <p>Inscription réussie !</p>
        </div>
      </div>
      @if(session('popup') == 'success')
        <script>
            window.onload = function(){
                showPopup('success-popup');
            };
        </script>
      @elseif(session('popup') == 'error')
          <script>
              window.onload = function() {
                  showPopup('error-popup');
              };
          </script>
      @endif
      <div class="custom-popup" id="error-popup">
        <div class="popup-content error-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      </div>  
      <div class="forms-container">
        <div class="signin-signup">
          <form action="{{url('/investisseurs/login')}}" class="sign-in-form" method="POST">
            @csrf
            <h2 class="title">Connexion</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="email"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"/>
            </div>
            <input type="submit" value="Connecter" class="btn solid" />
            <p class="social-text">Utiliser plutot un réseau social</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          <form action="{{url('/investisseurs/register')}}" class="sign-up-form" method="POST">
            @csrf
            <h2 class="title">Creer mon compte</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="nom"/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email"/>
            </div>
            <div class="input-field">
                <i class='bx bx-phone'></i>
                <input type="text" name="telephone" id="contact" placeholder="Enter your contact">
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"/>
            </div>
            <input type="submit" class="btn" value="Creer" />
            <p class="social-text">Utiliser plutot un réseau social</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
            NB: Vous pourrez completer les informtions de votre profil après etre connecté.
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Nouveau sur AgroTech?</h3>
                    <p>Découvrez une nouvelle façon de vivre l'agriculture avec AgroTech ! Créez votre compte particulier dès maintenant et accédez à une plateforme complète pour acheter des produits frais, trouver des projets agricoles passionnants en recherche d'investisseurs et publier vos propres projets. 
                        Rejoignez une communauté dynamique d'agriculteurs, d'investisseurs et de passionnés qui partagent votre amour pour l'agriculture. 
                        Relevez de nouveaux défis et explorez un monde d'opportunités agricoles sur AgroTech</p>
            <button class="btn transparent" id="sign-up-btn">
             Creer mon compte
            </button>
          </div>
          <img src="{{asset('images/log.svg')}}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Membre de AgroTech?</h3>
                    <p>Connectez-vous à votre compte AgroTech et poursuivez votre aventure agricole ! 
                        Accédez à une gamme complète de fonctionnalités, découvrez de nouveaux produits, explorez des projets passionnants et connectez-vous avec d'autres passionnés d'agriculture. 
                        Rejoignez-nous pour rester informé, échanger des idées et saisir de nouvelles opportunités sur AgroTech</p>
            <button class="btn transparent" id="sign-in-btn">
             Me Connecter
            </button>
          </div>
          <img src="{{asset('images/register.svg')}}" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="{{asset('js/comptes.js')}}"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        closePopup();
      });
  
      function showPopup(popupId) {
        closePopup(); // Masquer tous les pop-ups existants
        var popup = document.getElementById(popupId);
        popup.style.display = "block";
      }
  
      function closePopup() {
        var popups = document.getElementsByClassName("custom-popup");
        for (var i = 0; i < popups.length; i++) {
            popups[i].style.display = "none";
        }
      }
  </script>
  </body>
</html>

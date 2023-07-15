<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Votre Application de Météo.</title>
    <link rel="stylesheet" href="{{asset('css/weather.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{asset('js/weather.js')}}" defer></script>
  </head>
  <body>
    <h1>Météo Panel</h1>
    <div class="container">
      <div class="weather-input">
        <h3>Renseigner la ville</h3>
        <input class="city-input" type="text" placeholder="E.g., New York, London, Tokyo">
        <button class="search-btn">Météo</button>
        <div class="separator"></div>
        <button class="location-btn">Utiliser votre localisation</button>
      </div>
      <div class="weather-data">
        <div class="current-weather">
          <div class="details">
            <h2>_______ ( ______ )</h2>
            <h6>Température:__C</h6>
            <h6>Wind: __ M/S</h6>
            <h6>Humidité: __%</h6>
          </div>
        </div>
        <div class="days-forecast">
          <h2>Prévisions des 5 jours à venir</h2>
          <ul class="weather-cards">
            <li class="card">
              <h3>( ______ )</h3>
              <h6 id="temperature">Température: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidité: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Température: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidité: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Température: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidité: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Température: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidité: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Température: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidité: __%</h6>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <script>
      
    </script>
  </body>
</html>
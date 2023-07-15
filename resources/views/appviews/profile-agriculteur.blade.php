<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<!-- My CSS -->
	<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}" type="image/svg+xml">
	<title>MySmartCrops - Profil</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="{{asset('images/MSC.png')}}" alt="logo" srcset="" width="25%"> <br>
		</a>
		@if (auth('agriculteur')->check())
        <ul class="side-menu top">
            <li>
                <a href="{{url('dashboard')}}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard & Analytics</span>
                </a>
            </li>
            <li>
                <a href="{{url('store')}}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">My Store</span>
                </a>
            </li>
            <li>
                <a href="{{url('/notifications')}}" class="notification-icon">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Notifications</span>
                </a>
            </li>
            <li>
                <a href="{{url('/submit-projet/index')}}">
                    <i class='bx bxl-product-hunt'></i>
                    <span class="text">Soumettre un Projet</span>
                </a>
            </li>
            <li>
                <a href="{{url('/weather-app')}}">
                    <i class='bx bx-brightness-half'></i>
                    <span class="text">Mon Application de Météo</span>
                </a>
            </li>
        </ul>
        @endif
		<ul class="side-menu">
			@if (auth('agriculteur')->check())
            <li class="active">
				<a href="/agriculteurs/{{$agriculteur->id}}/details">
					<i class='bx bxs-cog' ></i>
					<span class="text">Paramètres</span>
				</a>
			</li>
			<li>
                <a href="{{url('/agriculteurs/logout')}}" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
			</li>
            @endif
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			@if(auth('agriculteur')->check())
            <a href="{{url('/notifications')}}" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">{{ count(auth('agriculteur')->user()->notifications) }}</span>
			</a>
            <a href="/agriculteurs/{{$agriculteur->id}}/details" class="profile">
				<img src="{{ asset('images/undraw_profile.svg') }}">
			</a>
            @endif
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Profil Agriculteur</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Profil</a>
						</li>
					</ul>
				</div>
			</div>
            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <i class='bx bx-search' ></i>
                        <i class='bx bx-filter' ></i>
                    </div>
                    <table> 
                        <div class="user-card">
                            <div class="content-left">
                              <img class="avatar" src="{{asset('images/undraw_profile.svg')}}" alt="User Avatar">
                            </div>
                            <div class="content-right">
                              <h2 class="username">Nom: {{ $agriculteur->nom != null ? $agriculteur->nom : "Non defini"}}</h2>
                              <p class="user-info">Prenoms: {{ $agriculteur->prenoms != null ?  $agriculteur->prenoms : "Non defini"}}</p>
                              <p class="user-info">Email: {{  $agriculteur->email != null ? $agriculteur->email : "Non Défini" }}</p>
                              <p class="user-info">Sexe: {{  $agriculteur->sexe != null ? $agriculteur->sexe : "Non Défini" }}</p>
                              <p class="user-info">Age: {{  $agriculteur->age != null ? $agriculteur->age : "Non Défini" }}</p>
                              <p class="user-info">Téléphone: {{  $agriculteur->telephone != null ? $agriculteur->telephone : "Non Défini" }}</p>
                              <p class="user-info">Région: {{  $agriculteur->region != null ? $agriculteur->region : "Non Défini" }}</p>
                              <p class="user-info">Ville: {{  $agriculteur->ville != null ? $agriculteur->ville : "Non Défini" }}</p>
                              <p class="user-info">Village: {{  $agriculteur->village != null ? $agriculteur->village : "Non Défini" }}</p>
                              <p class="user-info">Association: {{  $agriculteur->association != null ? $agriculteur->association : "Non Défini" }}</p>
                              <p class="user-info">Date de creation de compte: {{  $agriculteur->created_at != null ? $agriculteur->created_at : "Non Défini" }}</p>
                              <a class="btn" href="/agriculteurs/{{$agriculteur->id}}/showupdateform">Mettre à jour mon profil</a>
                            </div>
                          </div>                                                                                                                   
                    </table>
                </div>
            </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
    <script src="{{asset('js/dashboard.js')}}"></script>
</body>
</html>
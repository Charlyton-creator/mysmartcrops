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
        @if (auth('particulier')->check())
        <ul class="side-menu top">
			<li>
				<a href="{{url('dashboard')}}">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            <li>
				<a href="{{url('/particuliers/recharger-compte')}}">
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">Recharger mon compte</span>
				</a>
			</li>
		</ul>
        @endif
		<ul class="side-menu">
			@if (auth('particulier')->check())
            <li class="active">
				<a href="/particuliers/{{$particulier->id}}/details">
					<i class='bx bxs-cog' ></i>
					<span class="text">Paramètres</span>
				</a>
			</li>
			<li>
                <a href="{{url('/particuliers/logout')}}" class="logout">
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
			@if(auth('particulier')->check())
            <a href="{{url('/notifications')}}" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">{{ count(auth('particulier')->user()->notifications) }}</span>
			</a>
            <a href="/particuliers/{{$particulier->id}}/details" class="profile">
				<img src="{{ asset('images/undraw_profile.svg') }}">
			</a>
            @endif
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Profil Particulier</h1>
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
                                  <h2 class="username">Nom: {{ $particulier->noms != null ? $particulier->noms : "Non defini"}}</h2>
                                  <p class="user-info">Prenoms: {{ $particulier->prenoms != null ?  $particulier->prenoms : "Non defini"}}</p>
                                  <p class="user-info">Email: {{  $particulier->email != null ? $particulier->email : "Non Défini" }}</p>
                                  <p class="user-info">Sexe: {{  $particulier->sexe != null ? $particulier->sexe : "Non Défini" }}</p>
                                  <p class="user-info">Téléphone: {{  $particulier->telephone != null ? $particulier->telephone : "Non Défini" }}</p>
                                  <p class="user-info">Région: {{  $particulier->region != null ? $particulier->region : "Non Défini" }}</p>
                                  <p class="user-info">Ville: {{  $particulier->ville != null ? $particulier->ville : "Non Défini" }}</p>
                                  <p class="user-info">Compagnie: {{  $particulier->compagnie != null ? $particulier->compagnie : "Non Défini" }}</p>
                                  <p class="user-info">Date de creation de compte: {{  $particulier->created_at != null ? $particulier->created_at : "Non Défini" }}</p>
                                  <a class="btn" href="/particuliers/{{ $particulier->id }}/showupdateform">Mettre à jour mon profil</a>
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
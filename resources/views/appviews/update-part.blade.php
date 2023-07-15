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
	<title>MySmartCrops - Profil Mise à jour</title>
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
                            <form action="/particuliers/{{ $particulier->id }}/update" method="POST">
                                @csrf
                                <div class="container">
                                    <div class="form-box">
                                        <label for="nom">Nom</label>
                                        <input type="text" name="noms" class="field" placeholder="" value="{{$particulier->noms}}">
                                        <label for="prenoms">Prenoms</label>
                                        <input type="text" name="prenoms" class="field" placeholder="" value="{{$particulier->prenoms}}">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="" class="field" placeholder="" value="{{$particulier->email}}">
                                        <label for="sexe">Sexe</label>
                                        <input type="text" name="sexe" class="field" placeholder="" value="{{$particulier->sexe}}">
                                        <label for="telephone">Numéro de Téléphone</label>
                                        <input type="text" name="telephone" class="field" placeholder="" value="{{$particulier->telephone}}">
                                        <label for="region">Votre Region</label>
                                        <input type="text" name="region" class="field" placeholder="" value="{{$particulier->region}}">
                                        <label for="ville">Votre Ville</label>
                                        <input type="text" name="ville" class="field" placeholder="" value="{{$particulier->ville}}">
                                        <label for="association">Nom de votre entreprise/compagnie si vous en etes une</label>
                                        <input type="text" name="compagnie" class="field" placeholder="" value="{{$particulier->compagine}}">
                                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>   			                         
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
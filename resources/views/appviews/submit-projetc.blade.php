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
	<title>MySmartCrops - Soumettre un Projet</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="{{asset('images/MSC.png')}}" alt="logo" srcset="" width="25%"> <br>
		</a>
        @if (auth('agriculteur')->check())
            <ul class="side-menu top">
                <li class="">
                    <a href="{{url('dashboard')}}">
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard & Analytics</span>
                    </a>
                </li>
                <li class="active">
                    <a href="{{url('store')}}">
                        <i class='bx bxs-shopping-bag-alt'></i>
                        <span class="text">My Store</span>
                    </a>
                </li>
            </ul>
        @endif
		<ul class="side-menu">
            @if (auth('agriculteur')->check())
            <li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Paramètres</span>
				</a>
			</li>
			<li>
                <a href="{{url('/agriculteurs/logout')}}" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
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
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Soumettre un projet pour recherche d'investissement</h1>
					<ul class="breadcrumb">
						<li>
							<a href="{{url('dashboard')}}">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="">Soumettre Projet</a>
						</li>
					</ul>
				</div>
			</div>
            @if (auth('agriculteur')->check())
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Soumettre un projet pour trouver des investisseurs</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <form action="{{url('/submit-projet/store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="form-box">
                                        <label for="libelle">Quel désignation pour votre idée de projet?</label>
                                        <input type="text" name="designation" class="field" placeholder="">
                                        <label for="prix">Quel la valeur de l'investissement vous recherchez?</label>
                                        <input type="number" name="invest_amount" class="field" placeholder="">
                                        <label for="description">Donner nous un bref apperçu de votre projet</label>
                                        <textarea name="description" class="field" placeholder="Projet innovant pour la commune de la Kozah"></textarea>
                                        <label for="document">Ajouter un document Projet</label>
                                        <input type="file" class="field" name="document">
                                        <button class="btn btn-primary" type="submit">Soumettre</button>
                                    </div>
                                </div>
                            </form>                  
                        </table>  
                    </div>
                </div>
            @endif

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="{{asset('js/dashboard.js')}}"></script>
    <script>
    </script>
</body>
</html>
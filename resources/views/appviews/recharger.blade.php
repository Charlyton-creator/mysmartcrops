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
	<title>MySmartCrops - Recharger mon portefeuil </title>
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
            <li class="active">
				<a href="#">
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">Recharger mon compte</span>
				</a>
			</li>
		</ul>
        @endif
		<ul class="side-menu">
			@if (auth('particulier')->check())
            <li>
				<a href="#">
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
            <a href="/particuliers/{{auth('particulier')->user()->id}}/details" class="profile">
				<img src="{{ asset('images/undraw_profile.svg') }}">
			</a>
			@endif
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Recharge</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Recharger</a>
						</li>
					</ul>
				</div>
			</div>
            @if (auth('particulier')->check())
                <ul class="box-info">
                    <li>
                        <i class='bx bxs-shopping-bags'></i>
                        <span class="text">
                            <h3>10</h3>
                            <p>Commandes récents</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxl-shopify'></i>
                        <span class="text">
                            <h3>4</h3>
                            <p>Commandes Traités</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle' ></i>
                        <span class="text">
						<h3>{{auth('particulier')->user()->portefeuil->amount}} XOF</h3>
                            <p>Portefeuil</p>
                        </span>
                    </li>
                </ul>
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Recharge de Portefeuil</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table> 
							@if(session('payementsuccess')) 
								<div class="alert alert-success">
									<p>{{session('payementsuccess')}}</p>
								</div>
							@endif
							@if(session('payementcancelled')) 
								<div class="alert alert-error">
									<p>{{ session('payementcancelled') }}</p>
								</div>
							@endif	
								<form method="POST" action="{{url('/initialiser-recharge')}}" id="amountForm">
								<div class="container">
								  <div class="form-box">
									@csrf
									<div class="form-box">
									  <input type="number" id="amountInput" name="amount" class="field" placeholder="Montant de recharge">
									  <button class="btn btn-primary" type="submit" >Continuer et Finaliser</button> <br> <br>
									</div>
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
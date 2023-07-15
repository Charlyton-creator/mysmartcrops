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
	<title>AgroTech - Ajout de Parcelle</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AgroTech</span>
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
                <li>
                    <a href="#">
                        <i class='bx bxs-message-dots' ></i>
                        <span class="text">Message</span>
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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="{{url('dashboard')}}">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="">Ajouter Parcelle</a>
						</li>
					</ul>
				</div>
			</div>
            @if (auth('agriculteur')->check())
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Renseigner une nouvelle parcelle de terre</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <form action="{{url('/parcelle/store')}}" method="post">
                                @csrf
                                <div class="container">
                                    <div class="form-box">
                                        <label for="lieu">Lieu du parcelle</label>
                                        <input type="text" name="lieu" class="field" placeholder="">
                                        <label for="designation">Nom de la parcelle (Vous pouvez les nommées comme vous voulez)</label>
                                        <input type="text" name="designation" class="field" placeholder="Parcelle A">
                                        <label for="etendu">Etendu de la parcelle</label>
                                        <input type="text" name="etendu" class="field" placeholder="">
                                        <button class="btn btn-primary" type="submit">Sauvegarder</button>
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
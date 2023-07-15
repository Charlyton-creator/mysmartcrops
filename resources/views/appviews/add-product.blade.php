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
	<title>AgroTech - Ajout Produit</title>
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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="{{url('dashboard')}}">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="">Ajouter Produit</a>
						</li>
					</ul>
				</div>
			</div>
            @if (auth('agriculteur')->check())
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Ajouter un produit et le mettre en vente</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <form action="{{url('/produit/add')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="form-box">
                                        <label for="libelle">Nom du produit</label>
                                        <input type="text" name="nom" class="field" placeholder="">
                                        <label for="prix">Prix du produit</label>
                                        <input type="number" name="prix" class="field" placeholder="">
                                        <label for="poids_basic">Poids Basic en Vente(Quantité disponible)</label>
                                        <input type="number" name="quantite" class="field" placeholder="">
                                        <label for="">Plante associée</label>
                                        @if(empty(auth('agriculteur')->user()->cultures))
                                            <div class="not-present">
                                                <p> Aucune Plante actuellement disponible!!! </p>
                                            </div>
                                        @endif
                                        <select name="culture_id" id="" class="field">
                                            @foreach(auth('agriculteur')->user()->plants as $culture)
                                                <option value="{{$culture->id}}">{{ $culture->libelle }}</option>
                                            @endforeach
                                        </select>
                                        <label for="categorie">Catégorie du produit</label>
                                        @if(empty($categories))
                                            <div class="not-present">
                                                <p> Aucune Catégorie actuellement disponible!!! </p>
                                            </div>
                                        @endif
                                        <select name="categorie_id" id="" class="field">
                                            @foreach($categories as $categorie)
                                                <option value="{{$categorie->id}}">{{ $categorie->libelle }}</option>
                                            @endforeach
                                        </select>
                                        <label for="image">Image du Produit</label>
                                        <input type="file" class="field" name="image">
                                        <label for="type_vente">Ce Produit sera vendu par ?(Veuillez cocher une seule case):</label>
                                        <div>
                                            <input type="checkbox" name="unite" value="Unité" onchange="setSelectedCheckbox(this)">
                                            <label for="checkbox1">Unité</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="tas" value="Tas de 3" onchange="setSelectedCheckbox(this)">
                                            <label for="checkbox2">Tas de 3</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="bol" value="Bol" onchange="setSelectedCheckbox(this)">
                                            <label for="checkbox3">Bol</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="kilo" value="Kilo" onchange="setSelectedCheckbox(this)">
                                            <label for="checkbox4">Kilo</label>
                                        </div>
                                        <input type="hidden" name="selectedCheckbox" id="selectedCheckbox">
                                        <label for="vendre">Mettre en Vente?</label>
                                        <input type="checkbox" name="mise_en_vente" id="mise_en_vente" class=""> <br>
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
        function setSelectedCheckbox(checkbox) {
        if (checkbox.checked) {
          document.getElementById('selectedCheckbox').value = checkbox.value;
        } else {
          document.getElementById('selectedCheckbox').value = '';
        }
      }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}" type="image/svg+xml">
	<title>AgroTech - Store</title>
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
							<a class="active" href="">Store</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>
            @if (auth('agriculteur')->check())
                <ul class="box-info">
                    <li>
                        <i class='bx bx-polygon'></i>
                        <span class="text">
                            <h3>{{ count(auth('agriculteur')->user()->parcelles) }}</h3>
                            <p>Parcelles de Terrain</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bx-droplet'></i>
                        <span class="text">
                            <h3>{{ auth('agriculteur')->user()->varietes!= null ? count(auth('agriculteur')->user()->varietes): 0 }}</h3>
                            <p>Variétés de Plantes</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxl-periscope'></i>
                        <span class="text">
                            <h3>{{  auth('agriculteur')->user()->plants!= null ? count(auth('agriculteur')->user()->plants): 0 }}</h3>
                            <p>Plants</p>
                        </span>
                    </li>
                </ul>
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Mes Produits Disponible</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Categorie de Produit</th>
                                    <th>Description</th>
                                    <th>Mettre en Vente</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(empty($produitsNonEnVente))
                                    <div class="not-present">
                                        <p>Aucun produit actuellement en vente pour vous.</p>
                                    </div>
                                @endif
                                @foreach ($produitsNonEnVente as $produit)
                                    <tr>
                                        <td>
                                            <img src="{{asset('images/'.$produit->image)}}">
                                            <p>{{ $produit->nom }}</p>
                                        </td>
                                        <td>{{ $produit->prix }}</td>
                                        <td>{{ $produit->poids_base }}</td>
                                        <td>{{ $produit->categorie->libelle }}</td>
                                        <td>{{ $produit->description}}</td>
                                        <td> <input type="checkbox" name="vendre" id="checkbox_{{ $produit->id }}" onchange="mettreEnVente({{ $produit->id }})" class="field"> </td>
                                        <td>
                                            <div class="button-container">
                                                <a class="delete-button" href="#">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                                <a class="edit-button" href="#">
                                                    <i class='bx bx-edit'></i>
                                                </a>
                                            </div>
                                        </td>   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{url('/store/add_produit')}}" class="btn btn-primary">Ajouter un produit</a>
                    </div>
                    <div class="order">
                        <div class="head">
                            <h3>Mes Produits en Vente sur AgroTech</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Date de mise en marché</th>
                                    <th>Nombre d'achats</th>
                                    <th>Chiffre d'affaire</th>
                                    <th>Quantité restante</th>
                                    <th>Etat du Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(empty($produitsEnVente))
                                    <div class="not-present">
                                        <p>Aucun produit actuellement en vente pour vous.</p>
                                    </div>
                                @endif
                                @foreach ($produitsEnVente as $produit)
                                    <tr>
                                        <td>
                                            <img src="{{asset('images/'.$produit->image)}}">
                                            <p>{{ $produit->nom }}</p>
                                        </td>
                                        <td>{{ $produit->date_mise_en_vente }}</td>
                                        <td>{{ $produit->nombre_achats }}</td>
                                        <td>{{ $produit->chiffre_affaires }}</td>
                                        <td>{{ $produit->poids_base - $produit->nombre_achats }}</td>
                                        @if( ($produit->poids_base - $produit->nombre_achats) == 0)
                                            <td><span class="status pending">Epuisé</span></td>
                                        @elseif(($produit->poids_base - $produit->nombre_achats) > 10 and ($produit->poids_base - $produit->nombre_achats) <=100)
                                            <td><span class="status process">Bon état</span></td>
                                        @elseif(($produit->poids_base - $produit->nombre_achats) > 100)
                                            <td><span class="status completed">Stock Plein</span></td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="order">
                        <div class="head">
                            <h3>Mes Parcelles</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Lieu</th>
                                    <th>Etendu</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth('agriculteur')->user()->parcelles as $parcelle)
                                    <tr>
                                        <td>
                                            <p>{{ $parcelle->designation }}</p>
                                        </td>
                                        <td>{{ $parcelle->lieu }}</td>
                                        <td>{{ $parcelle->etendu }}</td>
                                        <td>
                                            <div class="button-container">
                                                <a class="delete-button" href="#">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                                <a class="edit-button" href="#">
                                                    <i class='bx bx-edit'></i>
                                                </a>
                                            </div>
                                        </td>                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="todo">
                        <div class="head">
                            <h3>Mes Varietes de Plantes</h3>
                            <i class='bx bx-plus' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Code Varieté</th>
                                    <th>Nombre de culture</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth('agriculteur')->user()->varietes as $variete)
                                    <tr>
                                        <td>
                                            <p>{{$variete->libelle}}</p>
                                        </td>
                                        <td>{{ $variete->code }}</td>
                                        <td>{{ !empty($variete->culture) ? count($variete->culture->get()) : 0 }}</td>
                                        <td>
                                            <div class="button-container">
                                                <a class="delete-button" href="#">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                                <a class="edit-button" href="#">
                                                    <i class='bx bx-edit'></i>
                                                </a>
                                            </div>
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{url('/agriculteur/variete/add')}}" class="btn btn-primary">Renseigner une varieté</a>
                    </div>
                    <div class="order">
                        <div class="head">
                            <h3>Mes Plantes</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Libelle</th>
                                    <th>Date Semence</th>
                                    <th>Date Entretien 1</th>
                                    <th>Engrais Utilisés</th>
                                    <th>Varieté</th>
                                    <th>Saison Agricole</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth('agriculteur')->user()->plants as $culture)
                                    <tr>
                                        <td>
                                            <p>{{ $culture->libelle }}</p>
                                        </td>
                                        <td>{{ $culture->date_semence }}</td>
                                        <td>{{ $culture->date_entretien_1 }}</td>
                                        <td>{{ $culture->engrais_utilises }}</td>
                                        <td>{{ $culture->variete->libelle }}</td>
                                        <td>{{ $culture->saisonculture->mois_debut }} - {{ $culture->saisonculture->mois_fin }} </td>
                                        <td>
                                            <div class="button-container">
                                                <a class="delete-button" href="#">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                                <a class="edit-button" href="#">
                                                    <i class='bx bx-edit'></i>
                                                </a>
                                            </div>
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{url('/agriculteur/plant/add')}}" class="btn btn-primary">Renseigner une nouvelle Plante</a>
                    </div>
                    
                    <div class="order">
                        <div class="head">
                            <h3>Mes Différents Cultures</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth('agriculteur')->user()->cultures as $culture)
                                    <tr>
                                        <td>
                                            <p>{{ $culture->nom }}</p>
                                        </td>
                                        <td>{{ $culture->description }}</td>
                                        <td>
                                            <div class="button-container">
                                                <a class="delete-button" href="#">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                                <a class="edit-button" href="#">
                                                    <i class='bx bx-edit'></i>
                                                </a>
                                            </div>
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{url('/agriculteur/culture/add')}}" class="btn btn-primary">Renseigner une nouvelle Culture</a>
                    </div>
                </div>
            @endif
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="{{asset('js/dashboard.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
function mettreEnVente(produitId) {
  var checkbox = document.getElementById('checkbox_' + produitId);
  var isChecked = checkbox.checked;

  if (isChecked) {
    var csrfToken = '{{ csrf_token() }}';
    var url = '{{ url('produit') }}/' + produitId + '/vendre';

    if (produitId) {
    // Effectuer la requête AJAX
        $.ajax({
        url: url,
        type: 'PUT',
        dataType: 'json',
        data: {
            _token: csrfToken
        },
        success: function (response) {
            if (response.success) {
            location.reload();
            } else {
            console.error('Erreur lors de la mise en vente du produit');
            }
        },
        error: function (xhr, status, error) {
            location.reload();
            console.log('Erreur AJAX : ' + error);
        }
        });
    }
    } else {
    console.error('produitId est manquant ou vide');
    }

    
}
    </script>
</body>
</html>
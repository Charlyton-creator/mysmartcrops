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
	<title>MySmartCrops - Profils Admin Panel </title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="{{asset('images/MSC.png')}}" alt="logo" srcset="" width="25%"> <br>
		</a>
        @if (auth('agriculteur')->check())
            <ul class="side-menu top">
                <li class="active">
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
        @if (auth('investisseur')->check())
            <ul class="side-menu top">
                <li class="active">
                    <a href="#">
                        <i class='bx bxs-dashboard' ></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/notifications')}}">
                        <i class='bx bxs-message-dots' ></i>
                        <span class="text">Messages</span>
                    </a>
                </li>
            </ul>
        @endif
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
            @if (auth('investisseur')->check())
            <li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Paramètres</span>
				</a>
			</li>
			<li>
                <a href="{{url('/investisseurs/logout')}}" class="logout">
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
            <a href="/agriculteurs/{{auth('agriculteur')->user()->id}}/details" class="profile">
				<img src="{{ asset('images/undraw_profile.svg') }}">
			</a>
            @endif
            @if(auth('particulier')->check())
            <a href="{{url('/notifications')}}" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">{{ count(auth('particulier')->user()->notifications) }}</span>
			</a>
            <a href="/particuliers/{{auth('particulier')->user()->id}}/details" class="profile">
				<img src="{{ asset('images/undraw_profile.svg') }}">
			</a>
            @endif
            @if(auth('investisseur')->check())
            <a href="{{url('/notifications')}}" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">{{ count(auth('investisseur')->user()->notifications) }}</span>
			</a>
            <a href="/investisseurs/{{auth('investisseur')->user()->id}}/details" class="profile">
				<img src="{{ asset('images/undraw_profile.svg') }}">
			</a>
            @endif
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
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
                        <i class='bx bxs-calendar-check' ></i>
                        <span class="text">
                            <h3>{{!empty($produitsCommandes) ? count($produitsCommandes) : 0}}</h3>
                            <p>Commandes reçus</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-group' ></i>
                        <span class="text">
                            <h3>{{!empty(auth('agriculteur')->user()->produits) ? count(auth('agriculteur')->user()->produits) : 0  }}</h3>
                            <p>Produits disponibles</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle' ></i>
                        <span class="text">
                            <h3>{{auth('agriculteur')->user()->portefeuil->amount}} XOF</h3>
                            <p>Chiffre d'affaire actuel</p>
                        </span>
                    </li>
                </ul>
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Commandes récentes</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date Order</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produitsCommandes as $item)
                                    <tr>
                                        <td>
                                            <img src="img/people.png">
                                            <p>{{$item->utilisateur}}</p>
                                        </td>
                                        <td>{{$item->date_commande}}</td>
                                        <td>
                                            @if($item->statut_commande == "initial")
                                                <span class="status pending">Initiale</span>
                                            @endif
                                            @if($item->statut_commande == "traité")
                                                <span class="status processed">Traitée</span>
                                            @endif
                                            @if($item->statut_commande == "traité")
                                                <span class="status completed">Livrée</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="order">
                        <div class="head">
                            <h3>Récoltes dans le temps</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <div>
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                    <div class="todo">
                        <div class="head">
                            <h3>Répartition des cultures par saison et variété</h3>
                            <i class='bx bx-plus' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        
                        <div><canvas id="pieChart"></canvas></div>
                    </div>
                    <div class="order">
                        <div class="head">
                            <h3>Chiffre d'Affaire par rapport aux saisons de ventes sur AgroTech</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <div id="lineChartContainer"><canvas id="lineChart"></canvas></div>
                    </div>
                   
                </div>
            @endif
            @if (auth('particulier')->check())
                <ul class="box-info">
                    <li>
                        <i class='bx bxs-shopping-bags'></i>
                        <span class="text">
                            @php
                             $count = count(auth('particulier')->user()->commandes->where('etat', 'initial'));
                             $traites = count(auth('particulier')->user()->commandes->where('etat', 'traitée'));
                            @endphp
                            <h3>{{ !empty(auth('particulier')->user()->commandes) ? $count : 0  }}</h3>
                            <p>Commandes récents</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxl-shopify'></i>
                        <span class="text">
                            <h3>{{ isset($traites) ? $traites : 0 }}</h3>
                            <p>Commandes Traités</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle' ></i>
                        <span class="text">
                            <h3>{{auth('particulier')->user()->portefeuil->amount}} XOF </h3>
                            <p>Portefeuil</p>
                        </span>
                    </li>
                </ul>
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Commandes récentes</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Numéro de Commande</th>
                                    <th>Date d'émission</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if($count = 0)
                                <div class="information-alert">
                                    <p>Vous n'avez aucune commande actuellement</p>
                                </div>
                                @else
                                    @foreach(auth('particulier')->user()->commandes as $commande)
                                    <tr>
                                        <td>
                                            <p>{{$commande->id}}</p>
                                        </td>
                                        <td>{{$commande->created_at}}</td>
                                        <td>
                                            @if($commande->etat == "initial")
                                                <span class="status completed">Initial</span>
                                            @endif
                                            @if($commande->etat == "traitée")
                                                <span class="status pending">Traité</span>
                                            @endif
                                            @if($commande->etat == "livrée")
                                                <span class="status process">Livrée</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif 
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if (auth('investisseur')->check())
                <ul class="box-info">
                    <li>
                        <i class='bx bxs-calendar-check' ></i>
                        <span class="text">
                            <h3>3</h3>
                            <p>Projets retenus</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <h3>5</h3>
                            <p>Projets Consultés</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle'></i>
                        <span class="text">
                            <h3>1</h3>
                            <p>Investissement(s) actif(s)</p>
                        </span>
                    </li>
                </ul>
                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Mes Investissements</h3>
                            <i class='bx bx-search' ></i>
                            <i class='bx bx-filter' ></i>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Projet</th>
                                    <th>Date de Contractualisation</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                Aucun investissement actif encours pour votre compte
                            </tbody>
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
    // Fonction pour créer le graphique à barres
function createBarChart() {
  // Code pour créer le graphique à barres
    var data = <?php echo isset($result) && $result !== null ? json_encode($result) : 'null'; ?>;

// Configurer les options du graphique
const options = {
  responsive: true,
  maintainAspectRatio: false,
  scales: {
    y: {
      beginAtZero: true,
      title: {
        display: true,
        text: 'Poids total des récoltes (Kg)',
      },
    },
    x: {
      title: {
        display: true,
        text: 'Saisons de culture',
      },
    },
  },
};

// Créer le graphique à barres
const ctx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: data.saisons,
    datasets: [
      {
        label: 'Évolution des récoltes par saison de culture',
        data: data.poids,
        backgroundColor: 'rgba(54, 162, 235, 0.8)', // Couleur des barres (bleu)
      },
    ],
  },
  options: options,
});
}

// Fonction pour créer le graphique en courbes

function createLineChart() {
  // Code pour créer le graphique en courbes
  const saisonsVente = <?php echo isset($tableauSaisons) && $tableauSaisons !== null ? json_encode($tableauSaisons) : '[]'; ?>;
  const chiffreAffaire = <?php echo isset($tableauChiffreAffaires) && $tableauChiffreAffaires !== null ? json_encode($tableauChiffreAffaires) : '[]'; ?>;
  console.log(chiffreAffaire);
// const saisonsVente = ["Saison 1", "Saison 2", "Saison 3", "Saison 4"]; // Remplacez par vos données réelles
// const chiffreAffaire = [5000, 8000, 6000, 9000]; // Remplacez par vos données réelles

// Créez un tableau d'objets pour les données du graphique
const data = {
  labels: saisonsVente,
  datasets: [{
    label: "Chiffre d'affaires",
    data: chiffreAffaire,
    fill: false,
    borderColor: 'orange',
    tension: 0.4
  }]
};

// Configurez les options du graphique
const options = {
  responsive: true,
  maintainAspectRatio: false,
  scales: {
    y: {
      beginAtZero: true
    }
  }
};

// Obtenez la référence du contexte du canevas
const ctx = document.getElementById('lineChart').getContext('2d');

// Créez le graphique en courbes
const lineChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: options
});
}

var data = <?php echo isset($data) && $data !== null ? json_encode($data) : 'null'; ?>;

// Fonction pour créer le graphique en secteurs
function createPieChart() {
  // Création du tableau des labels
  var labels = [];
  data.forEach(function (item) {
    var label = item.saison + " - " + item.variete;
    if (!labels.includes(label)) {
      labels.push(label);
    }
  });

  // Création du tableau des données
  var dataset = [];
  labels.forEach(function (label) {
    var saisonVariete = label.split(" - ");
    var saison = saisonVariete[0];
    var variete = saisonVariete[1];

    var nombreCultures = data.reduce(function (total, item) {
      if (item.saison === saison && item.variete === variete) {
        return total + item.nombreCultures;
      }
      return total;
    }, 0);

    dataset.push(nombreCultures);
  });

  // Configuration du graphique en secteurs
  var pieChartConfig = {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        data: dataset,
        backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)', 'rgba(153, 102, 255, 0.7)'],
      }],
    },
  };

  // Création du graphique en secteurs
  var pieChart = new Chart(document.getElementById('pieChart'), pieChartConfig);
}

// Appel de la fonction pour créer le graphique en secteurs
createPieChart();

// Appel des deux fonctions pour créer les graphiques
createBarChart();
createLineChart();
// Récupérer les données des récoltes depuis votre backend (par exemple, via une requête AJAX)

// Récupérez les données du chiffre d'affaires par saison de vente
</script>
</body>
</html>


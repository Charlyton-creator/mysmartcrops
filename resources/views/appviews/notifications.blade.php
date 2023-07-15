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
	<title>MySmartCrops - Profils Admin Panel</title>
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
                <a href="{{url('/investisseur/logout')}}" class="logout">
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
            <a href="/particuliers/{{ auth('particulier')->user()->id }}/details" class="profile">
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
					<h1>Notifications</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Notifications</a>
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
                        <div class="container">
                            <header>
                                <div class="notif-box">
                                        <span id="notifications"></span>
                                </div>
                                    <p id="mark_all">Marquer tous comme lus</p>
                            </header>
                            <main>
                                <div class="notif-card unread">
                                    <img src="{{asset('images/team-1.jpg')}}" alt="avatar">
                                    <div class="description">
                                        <p class="user_activity">
                                            <strong>Equipe MySmartCrops</strong> Vous informe que votre projet recement soumis a été publié sur la plateforme.
                                        </p>
                                        <p class="time">il y a 1min</p>
                                    </div>
                                </div>
                                <div class="notif-card unread">
                                    <img src="{{asset('images/team-1.jpg')}}" alt="avatar">
                                    <div class="description">
                                        <p class="user_activity">
                                            <strong>Charly</strong> Vient de commander votre produit <strong class="link">Mais Frais</strong> 
                                        </p>
                                        <p class="time">il y a 3min</p>
                                    </div>
                                </div>
                                <div class="notif-card unread">
                                    <img src="{{asset('images/team-1.jpg')}}" alt="avatar">
                                    <div class="description">
                                        <p class="user_activity">
                                            <strong>Youroukou</strong> Veut investir dans votre projet <b> Nom du projet </b>
                                        </p>
                                        <p class="time">il y a 3min</p>
                                    </div>
                                </div>
                                <div class="notif-card">
                                    <div class="message_card">
                                        <img src="{{asset('images/team-1.jpg')}}" alt="avatar">
                                        <div class="description">
                                            <p class="user_activity">
                                                <strong>
                                                    Mr Youth
                                                </strong> Vous a envoyez une demande personnalisée
                                            </p>
                                            <p class="time">il y a 5jours</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="message">
                                    <p>
                                        Bonjour je suis ravie d'etre un investisseur potentielle pour votre projet veuillez me contacter via ce email ou ce numero!
                                    </p> 
                                </div>
                                <div class="notif-card">
                                    <img src="{{asset('images/team-1.jpg')}}" alt="avatar">
                                    <div class="description">
                                        <p class="user_activity">
                                            <strong>Youroukou</strong> a commandé les tomates.
                                        </p>
                                        <p class="time">il y a 2 jours</p>
                                    </div>
                                </div>
                            </main>
                        </div> 					                         
                    </table>
                </div>
            </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	<script src="{{asset('js/dashboard.js')}}"></script>
<script>
const close = document.getElementById('notifications');
const notificationWrapper = document.querySelector('.container');
const notificationIcon = document.querySelector('.notification-icon');

notificationIcon.addEventListener('click', function() {
  notificationWrapper.classList.add('show');
});

close.addEventListener('click', function(){
    notificationWrapper.classList.remove('show');
});
const UnreadMessages = document.querySelectorAll('.unread');
const unread = document.getElementById("notifications");
const markAll = document.getElementById("mark_all");

unread.innerText = UnreadMessages.lenght;
UnreadMessages.forEach((message) => {
    message.addEventListener('click', () => {
        message.classList.remove('unread');
        const newUnreadMessages = document.querySelectorAll('.unread');
        unread.innerText = newUnreadMessages.lenght;
    });
});

markAll.addEventListener('click', () =>{
    UnreadMessages.forEach((message) => {
        message.classList.remove('unread');
    });
    const newUnreadMessages = document.querySelectorAll('.unread');
    unread.innerText = newUnreadMessages.lenght;
});
</script>
             
</body>
</html>
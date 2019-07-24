<!-- HEADER -->
<header>
<!-- CORPO i IDIOMES -->
	<div class="container">
		<div class="row">
			<div class="logo-container">
				<div class="corporatiu">
					<a href="{{route('home')}}">
						<img id="logo-big" src="{{asset('modules/front/img/logo.jpg')}}" alt="{{env('APP_NAME')}}"/>
						<!--img id="logo-resp" src="{{asset('modules/front/images/logo-resp.jpg')}}" alt="Front Intérim"/-->
					</a>
				</div>
			</div>
			<div class="menus">
				<div class="navbar-menu navbar-menu-main">
					<nav class="navbar">
						<div class="navbar-header navbar-header-main">
							<button id="btn-main-menu" class="navbar-toggle" type="button" data-toggle="collapse" data-target="#main-menu">
								<i class="fa fa-bars"></i>
							</button>
						</div>
						<div id="main-menu" class="collapse navbar-collapse js-navbar-collapse">
									@include ('front::partials.menu',
										["menu" => get_menu('header')]
									)
						</div><!-- /.nav-collapse -->
					</nav>
			</div>
			</div>


		</div>
	</div>


</header><!-- end HEADER -->

@push('javascripts')

@endpush

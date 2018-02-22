<?php
use \App\Util\SEO;
use \App\Util\XMLParser;

/*
$toolbar = \App\CmsArticle::whereHas('schemas', function ($query) {
    $query->where('front_view', 'seccion_toolbar');
})
->whereNull('parent_id')
->first()->children;
*/

$menu_top=\App\CmsArticle::select()
	->where('active', '1')
	->whereNull('parent_id')
	->orderBy('position')->get();
?>
<div class="container contenedor_header">
	<div class="logo">
		<a href="{{ url('/') }}">
			<img src="{{ asset('/assets/front/images/logo.jpg') }}">
		</a>					
	</div>
	<div class="box_topper">
		<nav>
		<ul class="menu">
		@foreach ($menu_top as $menu)
		<?php
			$show_menu=XMLParser::getValue($menu->param, 'show_menu')=='1';
			$show_page=XMLParser::getValue($menu->param, 'show_page')=='1';
			
			if(!$show_menu) continue;
			$smenus=$menu->submenu;
			$activo=$parent_0->id==$menu->id;
			$hasmen=count($smenus)>0;
		?>
			<li class="{{ $activo? 'activo': '' }} {{ $hasmen? '': 'conlink' }}">
			<?php
				$url=$show_page? url('/'.$menu->slug.'.html'): '#';
			?>
				<div class="menu_padre">{{ $menu->title }}
				<a href="{{ $url }}" class="full<?php if($hasmen) echo ' link_desktop'; ?>"></a>
				</div>
			@if($hasmen)
				<ul class="sub_menu">
				@foreach ($smenus as $smenu)
				<?php
					$items=$smenu->submenu;
					$url = SEO::url_article($smenu);
				?>
					<li class="conlink">
						<div class="menu_hijo">{{ $smenu->title }}
						<a href="{{ $url }}" class="full"></a>
						</div>
					</li>
				@endforeach
				</ul>
			@endif
			</li>
		@endforeach
		</ul>
		</nav>
		<div class="box_supperior">
			<ul class="menu_superior">
			@if(Auth::guest())
				<li>
					<a href="{{ url('/intranet/login') }}" class="full"></a>
					<div class="ico">
						<img src="{{ asset('/assets/front/images/header_login.png') }}" alt="Login">
					</div>
					Login Usuario
				</li>
			@else
				<li>
					<a href="{{ url('/intranet') }}">Bienvenido <span>{{ Auth::user()->name }}</span></a>
					<div class="btn_logout">
						<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="full"></a>
						<div class="ico">
							<img src="{{ asset('/assets/front/images/ico_logout.png') }}">
						</div>
						Logout
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
					</div>
				</li>
			@endif
			</ul>
			
		</div>
		
	</div>
</div>

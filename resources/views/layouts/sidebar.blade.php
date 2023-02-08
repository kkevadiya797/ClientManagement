<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			@php
					$settings = App\Models\Setting::first();
			@endphp
			<a href="index.html"><img src="{{ asset($settings->logo) }}" height="20" ></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="index.html"><img src="{{ asset($settings->favicon) }}" height="22" ></a>
		</div>
		<ul class="sidebar-menu">
			<li class="menu-header">Dashboard</li>
			@php
				$route_name = Illuminate\Support\Facades\Route::currentRouteName();	
			@endphp
			<li @if($route_name == 'dashboard') {{ 'class=active' }} @endif ><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
			
			{{-- <li class="menu-header">Client</li> --}}
			<li @if($route_name == 'client') {{ 'class=active' }} @endif ><a class="nav-link" href="{{ route('client') }}"><i class="fas fa-user"></i> <span>Client</span></a></li>

			{{-- <li class="menu-header">Staff</li> --}}
			<li @if($route_name == 'staff') {{ 'class=active' }} @endif ><a class="nav-link" href="{{ route('staff') }}"><i class="fas fa-users"></i> <span>Staff</span></a></li>

			{{-- <li class="menu-header">Projects</li> --}}
			<li @if($route_name == 'project') {{ 'class=active' }} @endif ><a class="nav-link" href="{{ route('project') }}"><i class="fas fa-list"></i> <span>Projects</span></a></li>
			
			{{-- <li class="menu-header">Settings</li> --}}
			<li @if($route_name == 'setting') {{ 'class=active' }} @endif ><a class="nav-link" href="{{ route('setting') }}"><i class="fas fa-cogs"></i> <span>Settings</span></a></li>
		</ul>
	</aside>
</div>
<div class='row'>
	<ul class="list-inline">
		<li>
			<a class="btn btn-link" href="{{ url('/') }}">Home</a>
		</li>

		<li>
			{{ link_to_route('entry.index', 'Main', [], ['class' => 'btn btn-link'] ) }}
		</li>

		<li>
			<a class="btn btn-link" href="{{ url('android') }}">Android</a>
		</li>

		<li>
			<a class="btn btn-link" href="{{ url('contact') }}">Contact</a>
		</li>

		<li id="auth">
            @if (Auth::guest())
				<div class="dropdown">
					<button class="dropbtn btn btn-link">Login</button>
					<div class="dropdown-content">
						<a href="{{ route('register') }}">Register</a>
						<a href="{{ route('login') }}">Login</a>
					</div>
				</div>     
            @else
				<div class="dropdown">
					<button class="dropbtn btn btn-link">{{ Auth::user()->name }}'s Account</button>
					<div class="dropdown-content">
	                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        {{ csrf_field() }}
	                    </form>		
	                </div>
				</div>                 
			@endif				
		</li>
	</ul>
</div>

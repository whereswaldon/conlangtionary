<nav class='main-nav'>
	<ul >
	    <li>
		<a href='{{route('languages.index')}}' alt='Language Management'>Languages</a>
	    </li>
        <li>
            <a href='{{route('descriptions.index')}}' alt='Description Management'>Descriptions</a>
        </li>
	    <li>
		<a href='{{route('words.index')}}' alt='Word Management'>Words</a>
	    </li>
        <li>
            <a href='{{route('definitions.index')}}' alt='Definition Management'>Definitions</a>
        </li>
	    @if(Auth::check())
	    <li>
		<a href='/auth/logout' alt='Logout'>Log Out</a>
	    </li>
	    @else
	    <li>
		<a href='/auth/register' alt='Register'>Create an Account</a>
	    </li>
	    <li>
		<a href='/auth/login' alt='Login'>Log In</a>
	    </li>
	    @endif
	</ul>
</nav>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">

    <a class="navbar-brand" href="#">Custom Auth</a>
    
        @if( auth()->check() )
            
                <a class="nav-link font-weight-bold" href="#">Hi {{ auth()->user()->name }}</a>
            
                <a class="nav-link" href="/logout">Log Out</a>
            
        @else
            
                <a class="nav-link" href="/login">Log In</a>
            
            
                <a class="nav-link" href="/register">Register</a>
            
        @endif
            

</nav>
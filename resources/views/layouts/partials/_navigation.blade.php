<nav class="nav">
    <div class="container">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="nav-item is-brand">
                {{ config('app.name') }}
            </a>
        </div>
         <span class="nav-toggle">
             <span></span>
             <span></span>
             <span></span>
         </span>
        <div class="nav-item nav-menu">
            @if(auth()->check())
               <a href="#" class="nav-item"     onclick="event.preventDefault(); document.getElementById('logout').submit();">
                    Sign Out
                </a>
                <a href="{{ route('account') }}" class="nav-item">
                    Your Account
                </a>
            @else
                <a href="{{ route('login') }}" class="nav-item">
                    Sign In
                </a>
                <div class="nav-item">
                <a href="{{ route('register') }}" class="button">
                    Start Selling
                </a>
            </div>
            @endif
        </div>
    </div>
</nav>

<form id="logout" action="{{ route('logout') }}" method="POST" class="is-hidden">
    @csrf
</form>
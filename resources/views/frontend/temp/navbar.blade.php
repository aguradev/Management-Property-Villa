<nav class="navbar navbar-expand-lg navbar-home">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Dweling</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link @if (url()->current() == '/') active @endif" aria-current="page"
                    href="{{ url('/') }}">Home</a>
                <a class="nav-link @if (Route::is('properties-list')) active @endif"
                    href="{{ route('properties-list') }}">Property</a>
            </div>
        </div>
    </div>
</nav>

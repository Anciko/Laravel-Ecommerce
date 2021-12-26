<nav class="navbar navbar-expand-lg navbar-light bg-dark shadow">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('admin-home') }}">E-commerce</a>
        <button class="navbar-toggler bg-info" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">{{ auth()->user()->name }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Jobs
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('categories.index') }}">
                            <i class="fas fa-th-large text-secondary  me-2"></i>Categories</a></li>
                        <li><a class="dropdown-item" href="{{ route('tags.index') }}">
                                <i class="fas fa-tags me-2 text-danger"></i>Tags
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">
                            <i class="fas fa-box me-2 text-success"></i>Products</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('user-logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

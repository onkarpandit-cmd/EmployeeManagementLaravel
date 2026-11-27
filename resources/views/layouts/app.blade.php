
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Employee Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

    <div class="d-flex">

        <!-- Sidebar -->
        <aside class="bg-dark text-white p-4"
               style="width:240px; min-height:100vh;">

            <h4 class="fw-bold mb-4">Employee MS</h4>

            @auth
                <a href="{{ route('employees.index') }}"
                   class="text-white d-block mt-4 text-decoration-none">
                    Dashboard
                </a>

                <a href="{{ route('employees.create') }}"
                   class="text-white d-block mt-3 text-decoration-none">
                    Add Employee
                </a>
            @endauth

        </aside>

        <!-- Main Content -->
        <div class="flex-grow-1">

            <!-- Top Navbar -->
            <nav class="navbar bg-white shadow-sm px-4 py-3">
                <span class="fw-semibold">Employee Management System</span>

                <div class="ms-auto">
                    @auth
                        <span class="me-3 text-secondary">
                            {{ Auth::user()->name }}
                        </span>

                        <form action="{{ route('logout') }}"
                              method="POST" class="d-inline">
                            @csrf
                            <button type="submit"
                                    class="btn btn-outline-danger btn-sm">
                                Logout
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"
                           class="btn btn-primary btn-sm">
                            Login
                        </a>
                    @endguest
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>

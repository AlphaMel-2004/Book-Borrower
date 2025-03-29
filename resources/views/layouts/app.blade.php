<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Borrower System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#4A90E2",
                        secondary: "#FF9800",
                        darkBg: "#1a202c",
                        darkText: "#e2e8f0",
                    }
                }
            }
        }
    </script>

    <style>
        body {
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding: 20px;
            transition: transform 0.3s ease-in-out;
        }
        .sidebar a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 270px;
            transition: margin-left 0.3s;
        }
        .toggle-btn {
            position: absolute;
            top: 20px;
            left: 270px;
            cursor: pointer;
            transition: left 0.3s;
        }
        .dark-mode {
            background-color: #1a202c;
            color: #e2e8f0;
        }
        .dark-mode .sidebar {
            background-color: #111827;
        }
        .dark-mode .sidebar a:hover {
            background-color: #374151;
        }
    </style>
</head>
<body class="{{ session('darkMode') === 'enabled' ? 'dark-mode' : '' }}">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h3 class="text-center text-warning">📚 BBS</h3>
        <a href="{{ route('books.index') }}"><i class="bi bi-house-door"></i> Home</a>
        <a href="{{ route('books.create') }}"><i class="bi bi-plus-circle"></i> Add Book</a>
        <button id="darkModeToggle" class="btn btn-outline-light w-100 mt-3">
            <i class="bi bi-moon"></i> Dark Mode
        </button>
    </div>

    <!-- Toggle Sidebar Button -->
    <button class="btn btn-dark toggle-btn" id="toggleSidebar">☰</button>

    <!-- Main Content -->
    <div class="content p-5" id="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 bg-dark text-white">
        <p class="m-0">📖 Book Borrower System Designed By: Rumel &copy; {{ date('Y') }}</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark Mode & Sidebar Toggle Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const darkModeToggle = document.getElementById("darkModeToggle");
            const body = document.body;
            const sidebar = document.getElementById("sidebar");
            const content = document.getElementById("content");
            const toggleBtn = document.getElementById("toggleSidebar");

            // Load dark mode preference
            if (localStorage.getItem("darkMode") === "enabled") {
                body.classList.add("dark-mode");
                darkModeToggle.innerHTML = '<i class="bi bi-sun"></i> Light Mode';
            }

            // Toggle dark mode
            darkModeToggle.addEventListener("click", function () {
                body.classList.toggle("dark-mode");
                if (body.classList.contains("dark-mode")) {
                    localStorage.setItem("darkMode", "enabled");
                    darkModeToggle.innerHTML = '<i class="bi bi-sun"></i> Light Mode';
                } else {
                    localStorage.setItem("darkMode", "disabled");
                    darkModeToggle.innerHTML = '<i class="bi bi-moon"></i> Dark Mode';
                }
            });

            // Toggle sidebar
            let sidebarVisible = true;
            toggleBtn.addEventListener("click", function () {
                if (sidebarVisible) {
                    sidebar.style.transform = "translateX(-100%)";
                    content.style.marginLeft = "20px";
                    toggleBtn.style.left = "20px";
                } else {
                    sidebar.style.transform = "translateX(0)";
                    content.style.marginLeft = "270px";
                    toggleBtn.style.left = "270px";
                }
                sidebarVisible = !sidebarVisible;
            });
        });
    </script>

</body>
</html>

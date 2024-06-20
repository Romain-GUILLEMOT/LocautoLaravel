<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
<div id="nav-wheel-bg"></div>
<nav id="nav-wheel">
    <a href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    <a href="{{ route('admin.users.index') }}">
        <i class="fas fa-users"></i> Users
    </a>
    <a href="{{ route('admin.invoices.index') }}">
        <i class="fas fa-file-invoice"></i> Invoices
    </a>
    <a href="{{ route('admin.cars.index') }}">
        <i class="fas fa-car"></i> Cars
    </a>
    <a href="{{ route('admin.reservations.index') }}">
        <i class="fas fa-calendar-check"></i> Reservations
    </a>
</nav>

<script>


    document.addEventListener('keydown', function(event) {
        if ((event.ctrlKey || event.metaKey) && event.key === 'i') {
            event.preventDefault();
            toggleNavWheel();
        } else if (event.key === 'Escape') {
            closeNavWheel();
        }
    });

    function toggleNavWheel() {
        const navWheel = document.getElementById('nav-wheel');
        const navWheelBg = document.getElementById('nav-wheel-bg');
        if (navWheel.style.display === 'none' || navWheel.style.display === '') {
            navWheel.style.display = 'flex';
            navWheelBg.style.display = 'block';
        } else {
            navWheel.style.display = 'none';
            navWheelBg.style.display = 'none';
        }
    }

    function closeNavWheel() {
        document.getElementById('nav-wheel').style.display = 'none';
        document.getElementById('nav-wheel-bg').style.display = 'none';
    }

    document.getElementById('nav-wheel-bg').addEventListener('click', closeNavWheel);
</script>
</body>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient text-black font-sans min-h-screen flex">
@include('admin.navbar')

<!-- Contenu principal -->
<div class="container py-8 px-4 box-bg rounded-lg shadow-lg mx-auto mt-8">
    <h1 class="text-4xl font-bold mb-6 text-center">Dashboard</h1>
    <p class="text-black p-2 text-center">To open the menu press <kbd>Ctrl+I</kbd> or <kbd>Cmd+I</kbd>.</p>

    <div class="p-4 mx-auto">
        <div class="mt-12">
            <div class="mb-12 grid gap-y-10 gap-x-6 md:grid-cols-2 xl:grid-cols-4">
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Today's Money</p>
                        <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">${{ number_format($todaysMoney, 2) }}</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="{{ $moneyChange >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ number_format($moneyChange, 2) }}%</strong>&nbsp;than yesterday
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <i class="fas fa-user-friends text-white text-2xl"></i>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Today's Users</p>
                        <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">{{ $todaysUsers }}</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="{{ $userChange >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ number_format($userChange, 2) }}%</strong>&nbsp;than yesterday
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">New Clients</p>
                        <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">{{ $newClients }}</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="{{ $clientChange >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ number_format($clientChange, 2) }}%</strong>&nbsp;than yesterday
                        </p>
                    </div>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
                    <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-orange-600 to-orange-400 text-white shadow-orange-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <div class="p-4 text-right">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Sales</p>
                        <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">${{ number_format($sales, 2) }}</h4>
                    </div>
                    <div class="border-t border-blue-gray-50 p-4">
                        <p class="block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600">
                            <strong class="{{ $salesChange >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ number_format($salesChange, 2) }}%</strong>&nbsp;than yesterday
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-12 grid gap-y-10 gap-x-6 md:grid-cols-2">
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-lg font-bold">Sales Overview</h5>
                    </div>
                    <canvas id="salesChart"></canvas>
                </div>
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-lg font-bold">Client Overview</h5>
                    </div>
                    <canvas id="clientsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    const salesData = @json($salesData);
    const clientsData = @json($clientsData);

    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: salesData.labels,
            datasets: [{
                label: 'Sales',
                data: salesData.data,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const clientsCtx = document.getElementById('clientsChart').getContext('2d');
    const clientsChart = new Chart(clientsCtx, {
        type: 'line',
        data: {
            labels: clientsData.labels,
            datasets: [{
                label: 'Clients',
                data: clientsData.data,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>

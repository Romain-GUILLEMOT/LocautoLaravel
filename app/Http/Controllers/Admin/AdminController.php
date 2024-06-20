<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $todaysMoney = Invoice::with('reservation.car')
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->sum(function ($invoice) {
                return $invoice->reservation->car->price;
            });

        $yesterdaysMoney = Invoice::with('reservation.car')
            ->whereDate('created_at', Carbon::yesterday())
            ->get()
            ->sum(function ($invoice) {
                return $invoice->reservation->car->price;
            });

        $todaysUsers = User::whereDate('created_at', Carbon::today())->count();
        $yesterdaysUsers = User::whereDate('created_at', Carbon::yesterday())->count();
        $newClients = User::where('created_at', '>=', Carbon::now()->subDay())->count();
        $oldClients = User::where('created_at', '>=', Carbon::now()->subDays(2)->subDay())->count();
        $sales = Invoice::with('reservation.car')
            ->get()
            ->sum(function ($invoice) {
                return $invoice->reservation->car->price;
            });

        $moneyChange = $yesterdaysMoney ? (($todaysMoney - $yesterdaysMoney) / $yesterdaysMoney) * 100 : 0;
        $userChange = $yesterdaysUsers ? (($todaysUsers - $yesterdaysUsers) / $yesterdaysUsers) * 100 : 0;
        $clientChange = $oldClients ? (($newClients - $oldClients) / $oldClients) * 100 : 0;
        $salesChange = $yesterdaysMoney ? (($sales - $yesterdaysMoney) / $yesterdaysMoney) * 100 : 0;

        // Préparer les données pour les graphiques
        $salesData = [
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'data' => [120, 150, 300, 200, 180, 90, 240] // Exemple de données
        ];

        $clientsData = [
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'data' => [5, 8, 12, 20, 15, 10, 18] // Exemple de données
        ];

        return view('admin.dashboard', compact('todaysMoney', 'todaysUsers', 'newClients', 'sales', 'moneyChange', 'userChange', 'clientChange', 'salesChange', 'salesData', 'clientsData'));
    }
}

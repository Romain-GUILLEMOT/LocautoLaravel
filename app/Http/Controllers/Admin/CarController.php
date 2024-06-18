<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    private function getCar(Request $request){
        $car = Car::query();
        if($request->search){
            $car
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('model', 'like', '%' . $request->search . '%')
                ->orWhere('price', 'like', '%' . $request->search . '%')
                ->orWhere('brand', 'like', '%' . $request->search . '%');
        }
        if($request->state){
            $car
                ->where('state', $request->state);
        }
        return $car->paginate(20);
    }
    public function index(Request $request)
    {
        $cars = $this->getCar($request);

        return view('admin.cars.index', compact('cars'));
    }



    public function store(Request $request)
    {
        $cars = $this->getCar($request);

        return redirect()->route('admin.cars.index', compact('cars'))->with('success', 'Car created successfully');
    }

    public function edit(Request $request,Car $car)
    {
        $car->update($request->all());
        $cars = $this->getCar($request);

        return view('admin.car.edit', compact('cars'))->with('success', 'Car edited successfully');
    }

    public function update(Request $request, Car $car)
    {
        $car->update($request->all());
        $cars = $this->getCar($request);

        return redirect()->route('admin.car.index', compact('cars'))->with('success', 'Car updated successfully');
    }

    public function destroy(Request $request, Car $car)
    {
        $car->delete();
        $cars = $this->getCar($request);

        return redirect()->route('admin.car.index', compact('cars'))->with('success', 'Car has been deleted');
    }
}

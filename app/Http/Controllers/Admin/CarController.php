<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    private function getCar(Request $request){
        $car = Car::query();
        if($request->archived) {
            //With trashed
            $car->onlyTrashed();

        }
        if($request->search){
            $car
                ->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('model', 'like', '%' . $request->search . '%')
                ->orWhere('id', 'like', '%' . $request->search . '%')
                ->orWhere('price', 'like', '%' . $request->search . '%')
                ->orWhere('brand', 'like', '%' . $request->search . '%');
        }
        if($request->state){
            $car
                ->where('state', $request->state);
        }
        if ($request->availability) {
            if ($request->availability == 'available') {
                $car->where('available', true);
            } elseif ($request->availability == 'not_available') {
                $car->where('available', false);
            }
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'model' => 'required|max:255',
            'date' => 'required|date',
            'brand' => 'required|max:255',
            'state' => 'required|max:255',
        ]);
        $validatedData['available'] = $request->get('available') === 'on';

        Car::create($validatedData);

        return redirect()->route('admin.cars.index', compact('cars'))->with('success', 'Car created successfully');
    }


    public function update(Request $request, Car $car)
    {
        $updateData = $request->all();
        $updateData['available'] = $request->get('available') === 'on';
        $car->update($updateData);
        $cars = $this->getCar($request);        $cars = $this->getCar($request);
        return redirect()->route('admin.cars.index', compact('cars'))->with('success', 'Car updated successfully');
    }

    public function destroy(Request $request, Car $car)
    {
        $car->delete();
        $cars = $this->getCar($request);

        return redirect()->route('admin.cars.index', compact('cars'))->with('success', 'Car has been deleted');
    }
}

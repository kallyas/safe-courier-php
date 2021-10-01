<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function showAllParcels()
    {
        return response()->json(Parcel::all());
    }

    public function showOneParcel($id)
    {
        return response()->json(Parcel::find($id));
    }

    public function showAllParcelsByUser($id)
    {
        return response()->json(Parcel::where('user_id', $id)->get());
    }

    public function createParcel(Request $request)
    {
        $parcel = Parcel::create($request->all());
        return response()->json($parcel, 201);
    }

    public function updateParcel(Request $request, $id)
    {
        $parcel = Parcel::findOrFail($id);
        $parcel->update($request->all());
        return response()->json($parcel, 200);
    }

    public function deleteParcel($id)
    {
        Parcel::findOrFail($id)->delete();
        return response()->json('Deleted Successfully', 200);
    }

    public function cancelParcel(Request $request, $id)
    {
        //set parcel status to cancelled
        $parcel = Parcel::findOrFail($id);
        $parcel->status = $request->status;
        $parcel->save();
        return response()->json($parcel, 200);
    }

    public function updateParcelDestination(Request $request, $id)
    {
        $parcel = Parcel::findOrFail($id);
        $parcel->to_location = $request->to_location;
        $parcel->save();
        return response()->json($parcel, 200);
    }

    public function updateParcelStatus(Request $request, $id)
    {
        $parcel = Parcel::findOrFail($id);
        $parcel->status = $request->status;
        $parcel->save();
        return response()->json($parcel, 200);
    }

    public function updatePresentLocation(Request $request, $id)
    {
        $parcel = Parcel::findOrFail($id);
        $parcel->present_location = $request->present_location;
        $parcel->save();
        return response()->json($parcel, 200);
    }
}

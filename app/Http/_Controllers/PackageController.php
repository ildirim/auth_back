<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Enums\StatusEnum;
use App\Models\Package;
use Validator;

class PackageController extends Controller
{
    public function index()
    {
        $data = [
            'packages' => Package::where('status', StatusEnum::ACTIVE_ID)->get(),
            'statusEnum' => StatusEnum::class
        ];

        return view('package/index', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'card_count' => 'required',
            'price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if( $validator->fails())
            return redirect()->back()->with('error', 'Please fill out all fields');

        $requestData = [
            'name' => $request->name,
            'card_count' => $request->card_count,
            'price' => $request->price,
            'status' => StatusEnum::ACTIVE_ID
        ];
        $response = Package::create($requestData);
        $message = $response ? ['success', 'Package stored successfully'] : ['error', 'Error! Please try again'];
        $message = $response ? ['success', 'Package stored successfully'] : ['error', 'Error! Please try again'];

        return redirect()->back()->with($message[0], $message[1]);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'name' => 'required',
            'card_count' => 'required',
            'price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if( $validator->fails())
            return back()->withErrors($validator);

        $requestData = [
            'name' => $request->name,
            'card_count' => $request->card_count,
            'price' => $request->price,
            'status' => StatusEnum::ACTIVE_ID
        ];

        $response = Package::where('id', $id)->update($requestData);
        $message = $response ? ['success', 'Package updated successfully'] : ['error', 'Error! Please try again'];

        return redirect()->back()->with($message[0], $message[1]);
    }

    public function delete($id)
    {
        $requestData = [
            'status' => StatusEnum::DEACTIVE_ID
        ];

        $response = Package::where('id', $id)->update($requestData);
        $message = $response ? ['success', 'Package deleted successfully'] : ['error', 'Error! Please try again'];

        return redirect()->back()->with($message[0], $message[1]);
    }
}

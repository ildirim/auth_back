<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Card;
use App\Enums\StatusEnum;
use Validator;

class CardController extends Controller
{
    public function index()
    {
        $data = [
            'cards' => Card::where('status', '!=', StatusEnum::DELETED_ID)->orderBy('id', 'desc')->get(),
            'statusEnum' => StatusEnum::class
        ];

        return view('card/index', $data);
    }

    public function create()
    {
        return view('card/create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'card_no' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if( $validator->fails())
            return redirect()->back()->with('error', 'Card number required');

        $requestData = [
            'card_no' => $request->card_no,
            'status' => StatusEnum::ACTIVE_ID
        ];

        $response = Card::create($requestData);
        $message = $response ? ['success', 'Card stored successfully'] : ['error', 'Error! Please try again'];

        return redirect()->back()->with($message[0], $message[1]);
    }

    public function edit($id)
    {
        $data = [
            'cards' => Card::where('id', $id)->first()
        ];

        return view('card/edit', $data);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'card_no' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if( $validator->fails())
            return back()->withErrors($validator);

        $requestData = [
            'card_no' => $request->card_no,
            'status' => $request->status
        ];

        $response = Card::where('id', $id)->update($requestData);
        $message = $response ? ['success', 'Card updated successfully'] : ['error', 'Error! Please try again'];

        return redirect()->back()->with($message[0], $message[1]);
    }

    public function delete($id)
    {
        $requestData = [
            'status' => StatusEnum::DELETED_ID
        ];

        $response = Card::where('id', $id)->update($requestData);
        $message = $response ? ['success', 'Card deleted successfully'] : ['error', 'Error! Please try again'];

        return redirect()->back()->with($message[0], $message[1]);
    }
}

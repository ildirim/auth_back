<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Rules\MatchOldPassword;
use App\Models\Card;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Enums\StatusEnum;
use Validator;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $data = [

        ];
        return view('profile/index', $data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,'.auth()->user()->id],
            'phone' => ['required'],
        ]);

        $requestData = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone
        ];
   
        User::find(auth()->user()->id)->update($requestData);
   
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function show($id)
    {
        $card = Card::select('cards.id', 'cards.card_no', 'cards.link_id', 'cards.contact_id', 'cards.document_id', 'cards.active', 'l.name as web_link', 'd.name as document_link', 'c.photo', 'c.full_name', 'c.company', 'c.department', 'c.role', 'c.address', 'c.mobile_number', 'c.fax_number', 'c.email', 'c.note')
                    ->join('links as l', 'l.id', '=', 'cards.link_id', 'left')
                    ->join('contacts as c', 'c.id', '=', 'cards.contact_id', 'left')
                    ->join('documents as d', 'd.id', '=', 'cards.document_id', 'left')
                    ->where('cards.user_id', $id)
                    ->where('status', StatusEnum::ACTIVE_ID)
                    ->first();
        if($card)
        {
            if($card->active == 'link')
                return redirect($card->web_link);
            elseif($card->active == 'document')
                return redirect('/uploads/document/' . $card->document_link);
            else
            {
                $data = [
                	'item' => $card
                ];

                return view('profile/show', $data);
            }
        }
        return redirect()->route('home');
    }
}

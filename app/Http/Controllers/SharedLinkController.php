<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Card;
use App\Models\Contact;
use App\Models\Link;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Validator;

class SharedLinkController extends Controller
{
    public function index()
    {
        $data = [
        	'card' => Card::where('user_id', auth()->user()->id)->first(),
        	'contact' => Contact::where('user_id', auth()->user()->id)->first(),
        	'webLink' => Link::where('user_id', auth()->user()->id)->first(),
        	'documentLink' => Document::where('user_id', auth()->user()->id)->first()
        ];

        return view('shared_link/index', $data);
    }

    public function storeOrUpdateWebLink(Request $request)
    {
    	$link = Link::where('user_id', auth()->user()->id)->first();

        $requestData = [
            'user_id' => auth()->user()->id,
            'name' => $request->name
        ];

    	if($link)
    		$response = Link::where('user_id', auth()->user()->id)->update($requestData);
    	else
        {
			$response = Link::create($requestData);
            Card::where('user_id', auth()->user()->id)->update(['link_id' => $response->id]);
        }


        return redirect()->back()->with('success', 'Web link updated successfully');
    }

    public function storeOrUpdateDocumentLink(Request $request)
    {
    	$document = Document::where('user_id', auth()->user()->id)->first();
    	if($request->file('name'))
        {
	        $uploadedFile = $request->file('name');
			$fileName = time().$uploadedFile->getClientOriginalName();
			$request->name->move(public_path('uploads/document'), $fileName);
		}
		else
	        return redirect()->back()->with('error', 'Please attach document file');

        $requestData = [
            'user_id' => auth()->user()->id,
            'name' => $fileName
        ];

    	if($document)
    		$response = Document::where('user_id', auth()->user()->id)->update($requestData);
    	else
        {
			$response = Document::create($requestData);
            Card::where('user_id', auth()->user()->id)->update(['document_id' => $response->id]);
        }

        return redirect()->back()->with('success', 'Document updated successfully');
    }

    public function storeOrUpdateContact(Request $request)
    {
    	$contact = Contact::where('user_id', auth()->user()->id)->first();

        if($request->file('photo'))
        {
	        $uploadedFile = $request->file('photo');
			$fileName = time().$uploadedFile->getClientOriginalName();
			$request->photo->move(public_path('uploads/contact'), $fileName);
		}
		$requestData = [
            'user_id' => auth()->user()->id,
            'photo' => $fileName ?? '',
            'full_name' => $request->full_name,
            'company' => $request->company,
            'department' => $request->department,
            'role' => $request->role,
            'address' => $request->address,
            'mobile_number' => $request->mobile_number,
            'fax_number' => $request->fax_number,
            'email' => $request->email,
            'note' => $request->note
        ];

    	if($contact)
    		$response = Contact::where('user_id', auth()->user()->id)->update($requestData);
    	else
        {
			$response = Contact::create($requestData);
            Card::where('user_id', auth()->user()->id)->update(['contact_id' => $response->id]);
        }

        return redirect()->back()->with('success', 'Contact updated successfully');
    }

    public function setActiveLink(Request $request)
    {
        Card::where('user_id', auth()->user()->id)->update(['active' => $request->id]);

    }
}

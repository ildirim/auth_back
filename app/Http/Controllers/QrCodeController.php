<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
	public function generate($text)
	{
		$imageName = strtoupper(md5(uniqid(rand(),true))) . '.png';
		$result = QrCode::size(500)
		            ->format('png')
		            ->generate($text, env('APP_URL') . '/public/' . $imageName));

		return $imageName;
	}
}
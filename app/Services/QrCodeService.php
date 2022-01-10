<?php
namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeService
{
	public function generate($text)
	{
		$result = Builder::create()
						    ->writer(new PngWriter())
						    ->writerOptions([])
						    ->data($text)
						    ->encoding(new Encoding('UTF-8'))
						    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
						    ->size(300)
						    ->margin(10)
						    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
						    ->labelText('')
						    ->labelFont(new NotoSans(20))
						    ->labelAlignment(new LabelAlignmentCenter())
						    ->build();

		$imageName = strtoupper(md5(uniqid(rand(),true))) . '.png';
		$result->saveToFile($this->publicPath('images/qr/' . $imageName));

		return $imageName;
	}

	function publicPath($path = null)
    {
        return rtrim(app()->basePath('public/' . $path), '/');
    }
}
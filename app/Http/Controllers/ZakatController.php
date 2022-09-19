<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MuktarSayedSaleh\ZakatTlv\Encoder;

use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;



class ZakatController extends Controller
{
     
    public function index()
     {

        // https://github.com/MukhtarSayedSaleh/saudi-zakat-qr-generator 
        // https://bestofphp.com/repo/MukhtarSayedSaleh-saudi-zakat-qr-generator
        // This the frist Temp to gernate the qrcode 
        $encoder = new Encoder();
        $qr_signature = $encoder->encode(
            "Axis Inspection - Sparehub",
            "1234567890",
            null,
            10000,
            150
        );
        var_dump($qr_signature);

        echo "<br><h1>ZakatController</h1>";
        //  return view('hissro');
     } 



    public function qrcode ()
    {

        // this code from https://github.com/SallaApp/ZATCA 
        // data:image/png;base64, .........
        // Export An image 

        $displayQRCodeAsBase64 = GenerateQrCode::fromArray(
            [
            new Seller('Salla'), // seller name        
            new TaxNumber('1234567891'), // seller tax number
            new InvoiceDate('2021-07-12T14:25:09Z'), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount('100.00'), // invoice total amount
            new InvoiceTaxAmount('15.00') // invoice tax amount
            // TODO :: Support others tags
            ])->render();

        echo '<img src="'.$displayQRCodeAsBase64.'"  />';
        echo $displayQRCodeAsBase64 ;

    }


    public function getData ()
    {

        
    }
}

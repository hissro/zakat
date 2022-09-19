<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;


class dummyAPI extends Controller
{
   
    public function show()
    {
        return ["name"=>"hissro"];
    }

 


    public function getQRcode(Request $request) 
    {
 
        $Seller = $request->input('Seller');
        $TaxNumber = $request->input('TaxNumber');
        $InvoiceDate = $request->input('InvoiceDate');
        $InvoiceTotalAmount = $request->input('InvoiceTotalAmount');
        $InvoiceTaxAmount = $request->input('InvoiceTaxAmount');



        if ( $Seller != null &&  $TaxNumber != null &&  $InvoiceDate != null &&  $InvoiceTotalAmount != null &&  $InvoiceTaxAmount != null  )
        {     
          $displayQRCodeAsBase64 = GenerateQrCode::fromArray(
            [
            new Seller($Seller),         
            new TaxNumber($TaxNumber),  
            new InvoiceDate($InvoiceDate),   
            new InvoiceTotalAmount($InvoiceTotalAmount),  
            new InvoiceTaxAmount($InvoiceTaxAmount)  
            // TODO :: Support others tags
            ])->render();
            return ["responsecode"=> 200 ,   "response" => true ,"image"=>$displayQRCodeAsBase64];
        }
        else 
        {
          return ["responsecode"=> 500 , "response" => false ,
          "message"=>"please fill out all required fields (Seller, TaxNumber, InvoiceDate, InvoiceTotalAmount, InvoiceTaxAmount) "];
        }  
    }
}

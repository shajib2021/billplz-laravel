<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $amount = 100;
        $combined_order_id = rand(10000,99999);
        $first_name = 'shajaj';
        $phone = '01675088906';
        $email = 'ssssss@sss.com';




        $option = array(
    'userSecretKey' => config('toyyibpay.key'),
    'categoryCode' => config('toyyibpay.category'),
    'billName' => 'Test',
    'billDescription' => 'TEST On Sunday',
    'billPriceSetting' => 1,
    'billPayorInfo' => 1,
    'billAmount'=> $amount,
    'billReturnUrl'=> route('toyyibpay-status'),
    'billExternalReferenceNo' => $combined_order_id,
    'billTo' => $first_name,
    'billEmail' =>  $email,
    'billPhone'=> $phone,
    'billSplitPayment' => 0,
    'billSplitPaymentArgs'=>'',
    'billPaymentChannel' => 2,
    'billContentEmail'=>'Thank you for purchasing our product!',
    'billChargeToCustomer'=>''
  );

       $url='https://dev.toyyibpay.com/index.php/api/createBill';
       $response = Http::asForm()->post($url, $option);
       $billcode = $response[0]['BillCode'];
       return redirect('https://dev.toyyibpay.com/' . $billcode);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function paymentstatus()
    {

        $response= request()->status_id;

        if(($response)==1)
        return $response;
        else
        echo "fail";
    }

    public function callback()
    {

       $response= request()->all(['refno','status','reason','billcode','order_id','amount']);
       Log::info($response);
    }

}

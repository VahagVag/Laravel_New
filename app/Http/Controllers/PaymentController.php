<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public $gateway;
    public $completePaymentUrl;

    public function __construct()
    {
        $this->gateway = Omnipay::create('Stripe\PaymentIntents');
        $this->gateway->setApiKey(env('STRIPE_SECRET_KEY'));
        $this->completePaymentUrl = url('confirm');

    }


    public function index($id)
    {
        $project = Project::find($id);
        $categories = Category::all();
        return view('UsersPanel.buy',compact('project','categories'));

    }

    public function charge(Request $request)

    {

        if($request->input('stripeToken'))
        {

            $token = $request->input('stripeToken');

            $response = $this->gateway->authorize([

                'amount' => $request->input('amount'),
                'currency' => env('STRIPE_CURRENCY'),
                'description' => 'Test purchase transaction',
                'token' => $token,
                'returnUrl' => $this->completePaymentUrl,
                'confirm' => true

            ])->send();

            if($response->isSuccessful())
            {
                $response = $this->gateway->capture([
                    'amount' => $request->input('amount'),
                    'currency' => env('STRIPE_CURRENCY'),
                    'paymentIntentReference' => $response->getpaymentIntentReference(),
                ])->send();

                $arr_payment_data = $response->getData();


                $this->store_payment([
                    'payment_id' => $arr_payment_data['id'],
                    'payer_email' => $request->input('email'),
                    'amount' => $arr_payment_data['amount'] / 100,
                    'currency' => env('STRIPE_CURRENCY'),
                    'payment_status' => $arr_payment_data['status'],
                    'project_id' => $request['project_id'],

                ]);
                return redirect("/projects/index")->with("success","Payment is successful payment id is: ". $arr_payment_data['id']);
            }
            elseif($response->isRedirect())
            {
                session(['payer_email' => $request->input('payer_email')]);
                $response->redirect();

            }
            else
            {
                return redirect("/projects/index")->with("error",$response->getMessage());
            }
        }
    }

    public function confirm(Request $request)
    {
        $response = $this->gateway->confirm([
            'paymentIntentReference' => $request->input('payment_intent'),
            'returnUrl' => $this->completePaymentUrl,
        ])->send();

        if($response->isSuccessful())
        {
            $response = $this->gateway->capture([
                'amount' => $request->input('amount'),
                'currency' => env('STRIPE_CURRENCY'),
                'paymentIntentReference' => $request->input('payment_intent'),
            ])->send();

            $arr_payment_data = $response->getData();



            $this->store_payment([
                'payment_id' => $arr_payment_data['id'],
                'payer_email' => session('payer_email'),
                'amount' => $arr_payment_data['amount'] / 100,
                'currency' => env('STRIPE_CURRENCY'),
                'payment_status' => $arr_payment_data['status'],
                'user_id' => Auth::user()->id,
                'project_id' => $request['project_id'],
            ]);

            return redirect("payment")->with("success","Payment is successful payment id is: ". $arr_payment_data['id']);
        }
        else
        {
            return redirect("payment")->with("error",$response->getMessage());
        }
    }
    public function store_payment($arr_data = [])
{
    $payment = new Payment;
    $payment->payment_id = $arr_data['payment_id'];
    $payment->payer_email = $arr_data['payer_email'];
    $payment->amount = $arr_data['amount'];
    $payment->currency = env('STRIPE_CURRENCY');
    $payment->payment_status = $arr_data['payment_status'];
    $payment->user_id = Auth::user()->id;
    $payment->project_id = $arr_data['project_id'];
    $payment->save();

}

}

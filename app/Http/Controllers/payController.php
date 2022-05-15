<?php


namespace App\Http\Controllers;


use App\Models\order;
use Illuminate\Http\Request;
use nusoap_client;

class payController extends Controller
{
    public function mobilepay($id)
    {
    session(['mobilepay' => "okey"]);
    $this->pay($id,"mobile");
    
    }
    public function pay($id,$pd="")
{
    $order=order::findOrFail($id);

    $terminalId		= "5619110";							//-- شناسه ترمینال
    $userName		= "bimebash"; 							//-- نام کاربری
    $userPassword	= "93899878"; 							//-- کلمه عبور
    $orderId		= $order->id.rand(1000,9999);							//-- شناسه فاکتور
    $amount 		=$order->price; 							//-- مبلغ به ریال
    $callBackUrl	= "http://www.bimebashe.ir/response".$pd;	//-- لینک کال بک
    $localDate		= date('Ymd');
    $localTime		= date('Gis');
    $additionalData	= "";
    $payerId		= $order->id.rand(1000,9999);

//-- تبدیل اطلاعات به آرایه برای ارسال به بانک
    $parameters = array(
        'terminalId' 		=> $terminalId,
        'userName' 			=> $userName,
        'userPassword' 		=> $userPassword,
        'orderId' 			=> $orderId,
        'amount' 			=> $amount,
        'localDate' 		=> $localDate,
        'localTime' 		=> $localTime,
        'additionalData' 	=> $additionalData,
        'callBackUrl' 		=> $callBackUrl,
        'payerId' 			=> $payerId
    );

    $client 	= new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
    $namespace 	='http://interfaces.core.sw.bps.com/';
    $result 	= $client->call('bpPayRequest', $parameters, $namespace);

//-- بررسی وجود خطا
    if ($client->fault)
    {
        //-- نمایش خطا
        die("خطا در اتصال به وب سرویس بانک");
    } else {
        $err = $client->getError();

        if ($err)
        {
            //-- نمایش خطا
            die($err);
        } else {
            $res 		= explode (',',$result);
            $ResCode 	= $res[0];

            if ($ResCode == "0")
            {
                //-- انتقال به درگاه پرداخت
                echo "<form name='myform' action='https://bpm.shaparak.ir/pgwchannel/startpay.mellat' method='POST'><input type='hidden' id='RefId' name='RefId' value='{$res[1]}'></form><script type='text/javascript'>window.onload = formSubmit; function formSubmit() { document.forms[0].submit(); }</script>";
            } else {
                //-- نمایش خطا
                die($result);
            }
        }
    }
}
    public function response(Request $request)
    {
        $terminalId		= "5619110"; //-- شناسه ترمینال
        $userName		= "bimebash"; //-- نام کاربری
        $userPassword	= "93899878"; //-- کلمه عبور

        $ResCode 		= (isset($_POST['ResCode']) && $_POST['ResCode'] != "") ? $_POST['ResCode'] : "";

        if ($ResCode == '0')
        {
            $client 				= new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
            $namespace 				='http://interfaces.core.sw.bps.com/';
            $orderId 				= (isset($_POST['SaleOrderId']) && $_POST['SaleOrderId'] != "") ? $_POST['SaleOrderId'] : "";
            $verifySaleOrderId 		= (isset($_POST['SaleOrderId']) && $_POST['SaleOrderId'] != "") ? $_POST['SaleOrderId'] : "";
            $verifySaleReferenceId 	= (isset($_POST['SaleReferenceId']) && $_POST['SaleReferenceId'] != "") ? $_POST['SaleReferenceId'] : "";

            $parameters = array(
                'terminalId' 		=> $terminalId,
                'userName' 			=> $userName,
                'userPassword' 		=> $userPassword,
                'orderId' 			=> $orderId,
                'saleOrderId' 		=> $verifySaleOrderId,
                'saleReferenceId' 	=> $verifySaleReferenceId
            );

            $result = $client->call('bpVerifyRequest', $parameters, $namespace);

            if($result == 0)
            {
                $result = $client->call('bpSettleRequest', $parameters, $namespace);

                if($result == 0)
                {
                    //-- تمام مراحل پرداخت به درستی انجام شد.
                    $o=order::find(substr($orderId,0,strlen($orderId)-4));
                    $o->state=2;
                    $o->transaction_code=$verifySaleReferenceId;
                    $o->save();
                    return view("website.back",compact(["verifySaleReferenceId"]));

                } else {
                    $client->call('bpReversalRequest', $parameters, $namespace);

                    //-- نمایش خطا
                    $error_msg = (isset($result) && $result != "") ? $result : "خطا در ثبت درخواست واریز وجه";
                    die($error_msg);
                }
            } else {
                $client->call('bpReversalRequest', $parameters, $namespace);

                //-- نمایش خطا
                $error_msg = (isset($result) && $result != "") ? $result : "خطا در عملیات وریفای تراکنش";
                die($error_msg);
            }
        } else {
            //-- نمایش خطا
            $error_msg = (isset($ResCode) && $ResCode != "") ? $ResCode : "تراکنش ناموفق";
            die($error_msg);
        }
    }
    public function responsemobile(Request $request)
    {
        $terminalId		= "5619110"; //-- شناسه ترمینال
        $userName		= "bimebash"; //-- نام کاربری
        $userPassword	= "93899878"; //-- کلمه عبور

        $ResCode 		= (isset($_POST['ResCode']) && $_POST['ResCode'] != "") ? $_POST['ResCode'] : "";

        if ($ResCode == '0')
        {
            $client 				= new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
            $namespace 				='http://interfaces.core.sw.bps.com/';
            $orderId 				= (isset($_POST['SaleOrderId']) && $_POST['SaleOrderId'] != "") ? $_POST['SaleOrderId'] : "";
            $verifySaleOrderId 		= (isset($_POST['SaleOrderId']) && $_POST['SaleOrderId'] != "") ? $_POST['SaleOrderId'] : "";
            $verifySaleReferenceId 	= (isset($_POST['SaleReferenceId']) && $_POST['SaleReferenceId'] != "") ? $_POST['SaleReferenceId'] : "";

            $parameters = array(
                'terminalId' 		=> $terminalId,
                'userName' 			=> $userName,
                'userPassword' 		=> $userPassword,
                'orderId' 			=> $orderId,
                'saleOrderId' 		=> $verifySaleOrderId,
                'saleReferenceId' 	=> $verifySaleReferenceId
            );

            $result = $client->call('bpVerifyRequest', $parameters, $namespace);

            if($result == 0)
            {
                $result = $client->call('bpSettleRequest', $parameters, $namespace);

                if($result == 0)
                {
                    //-- تمام مراحل پرداخت به درستی انجام شد.
                    $o=order::find(substr($orderId,0,strlen($orderId)-4));
                    $o->state=2;
                    $o->transaction_code=$verifySaleReferenceId;
                    $o->save();
                    return view("website.confirm",compact(["verifySaleReferenceId"]));

                } else {
                    $client->call('bpReversalRequest', $parameters, $namespace);
                    return view("website.error");
                    //-- نمایش خطا
                    $error_msg = (isset($result) && $result != "") ? $result : "خطا در ثبت درخواست واریز وجه";
                    die($error_msg);
                }
            } else {
                $client->call('bpReversalRequest', $parameters, $namespace);
return view("website.error");
                //-- نمایش خطا
                $error_msg = (isset($result) && $result != "") ? $result : "خطا در عملیات وریفای تراکنش";
                die($error_msg);
            }
        } else {
            //-- نمایش خطا
            $error_msg = (isset($ResCode) && $ResCode != "") ? $ResCode : "تراکنش ناموفق";
            return view("website.error");
            die($error_msg);
        }
    }

}
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=8">
<?php

$var_amount =$_GET['amnt'];
$clientip = $_SERVER['REMOTE_ADDR'];
//$realIP = file_get_contents("http://ipecho.net/plain");
$curl = curl_init();
 $post_fields = "command=V&amount=".$var_amount."00&currency=981&client_ip_addr=".$clientip."&description=FREEGEORGIA&msg_type=SMS";
        $submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		Curl_setopt($curl, CURLOPT_SSLVERSION, 1); //0 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($curl, CURLOPT_VERBOSE, '1');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
      	curl_setopt($curl, CURLOPT_SSLCERT,         getcwd().'/payment/sert.pem');
 		curl_setopt($curl, CURLOPT_SSLKEYPASSWD,   'GCaYpY2j003T8JC9');
        curl_setopt($curl, CURLOPT_URL, $submit_url);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);

if(curl_errno($curl))
{
    echo 'curl error: ' . curl_error($curl)."<BR>";
}
        curl_close($curl);
//echo $result;
//echo "<BR><BR>";

	$result=substr($result,-28);
	
	echo "REDIRECT ........";
//echo print_r($info);
//echo "<BR><BR>";
// აქ აკეთებს ბაზაში ჩანაწერს, მაგრამ სტატუსი არის ჯერ უარყოფილი
	if($result){
		require_once("cnf/conn.php");
		$username =$_GET['username'];
		$idnumber =$_GET['idnumber'];
		$amount =$_GET['amnt'];
		$transid = $result;
		$date="Y-m-d";
		$insert->AddPayment($username,$idnumber,$transid,$amount,$date);
	}
	$curl = curl_init();
?>
<!--<html>
<head>
<title>Merchant example post template to ECOMM</title>
<script type='text/javascript' language='javascript'>
function redirect() {
  document.returnform.submit();
}
</script>
</head>
<!-- აქ აკეტებს გადამისამრთებას გადახდის გვერდზე -->
<body onLoad='javascript:redirect()'>
<form name='returnform' action='https://ecommerce.ufc.ge/ecomm2/ClientHandler' method='POST'>
  <input type='hidden' name='trans_id' value='<?php //echo $result; ?>'>
<noscript>
    <center>Please click the submit button below.<br>
    <input type='submit' name='submit' value='Submit'></center>
</noscript>
</form>
 
</body>
</html>       

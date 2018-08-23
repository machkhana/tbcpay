<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=8">
	
		<?php
		echo "ORIGINAR TRANSACTION:  " . $TRX_ID2=$_REQUEST['trans_id']; 
		echo "</br>" . "</br>";
		//echo $_POST['Ucaf_Cardholder_Confirm'] . "</br>'";
		//echo $_POST['RemoteAddress'] . "</br>'";
		echo $TRX_ID=urlencode($TRX_ID2); 
		 echo "</br>" . "</br>";

		?>
		
<?php

	$clientip = $_SERVER['REMOTE_ADDR'];
	$curl = curl_init();
	$post_fields = "command=c&trans_id=". $TRX_ID . "&client_ip_addr=".$clientip."";

		$submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
		Curl_setopt($curl, CURLOPT_SSLVERSION, 1); //0 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($curl, CURLOPT_VERBOSE, '1');
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 120);
		curl_setopt($curl, CURLOPT_SSLCERT,         getcwd().'/payment/sert.pem');
		curl_setopt($curl, CURLOPT_SSLKEYPASSWD,   'FGkl67ro7XDFHgfdiy57hg');
		curl_setopt($curl, CURLOPT_URL, $submit_url);
		$result = curl_exec($curl);
		$info = curl_getinfo($curl);
	
		if(curl_errno($curl))
		{
			echo 'curl error:' . curl_error($curl)."<BR>";
		}
			curl_close($curl);
	//echo $result;
	//echo "<BR><BR>";
	echo $result;  // =substr($result,-28);
	$result=substr($result,-28);
  // აქ აკეტებს ჩასწორებას ბაზაში როდესაც ტრანზაქცია ჭეშმარიტია ჩასწორებას აკეტებს ბაზაში სტატუსის როომ გადახდა წარმატებული
	if($result){
		require_once("cnf/conn.php");
		$insert->UpdatePayment($transid);
	}
	//echo print_r($info);
	//echo "<BR><BR>";
	$curl = curl_init();
?>
	
	
	
	
	
	

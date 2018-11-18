    <?php
    	// Account details
    	$apiKey = urlencode('l1VHpIM6ch4-gbbSxXWmfHgDMEPsFYua1is1DMe9fC');
    	
    	// Message details
    	$numbers = array(919299955669);
    	$sender = urlencode('TXTLCL');
    	$message = rawurlencode('This is SARATH GVND');
     
    	$numbers = implode(',', $numbers);
     
    	// Prepare data for POST request
    	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
     
    	// Send the POST request with cURL
    	$ch = curl_init('https://api.textlocal.in/send/');
    	curl_setopt($ch, CURLOPT_POST, true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$response = curl_exec($ch);
    	curl_close($ch);
    	if(strpos($response,'"status":"failure"') == true)
	    {
		  echo "OTP Failed to send<br>";
		}
		else
		{
		  echo "OTP sent successfully!!!";
		}
    	// Process your response here
    	//echo $response;
    ?>


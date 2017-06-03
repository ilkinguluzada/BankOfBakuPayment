    <?php 
    if($_SERVER['REQUEST_METHOD']=='POST'){
      
      //Sifarish melumatlari
      $packet_id = $_POST['packet_id'];
      
     
	     $servername = "localhost";
     	$username = "username";
     	$password = "password";
    	 $dbname = "database";
    	 
	// Elaqe Yarat
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	
	$sql = "SELECT * FROM packets WHERE packet_id = '$packet_id'";
	$result = mysqli_query($conn, $sql);
	
	
	    
	    while($row = mysqli_fetch_assoc($result)) {
	        $packet_name = $row["packet_name"];
	        $packet_price = $row["cost"];
	    }
	
	mysqli_close($conn);
	

	
	
	
      //User Melumatlari
      $user_id =  $row_head['user_id'];
      $user_email = $row_head['email'];
      $user_name = $row_head['username'];
      
      $successurl = "";
      
      $failurl = "";
     
      
      //key
      $openKey = "";
      $privateKey = "";
      
	
	$cardType = $_POST['cardType'];
	$phone = $_POST['phone'];
	
	
		
	      $amount = $packet_price;
   	echo $amount;
		    $params = array();
                    $params['amount'] = $amount;
                    $params['phone'] = $phone;
                    $params['email'] = $user_email;
                    $params['description' ] = 'Rufaly';
                    $params['cardType' ] = $cardType;
                    $params['taksit' ] = 0;
                    $params['payFormType' ] = 'DESKTOP';
                    $params['successUrl' ] = $successurl;
                    $params['errorUrl' ] = $failurl;
                    $params['key'] = $openKey; //you open key

                    ksort($params);
                    $sum = '';
                    foreach ($params as $k => $v) {
                        $sum .= (string)$v;
                    }
                    $sum .= $privateKey ; //your private key
                    $control_sum = md5($sum);


 $decoded= json_decode(file_get_contents("https://epos.az/api/pay2me/pay/?key=$openKey&sum=$control_sum&amount=$amount&phone=$phone&email=$user_email&description=Rufaly&cardType=$cardType&taksit=0&payFormType=DESKTOP&successUrl=$successurl&errorUrl=$failurl"),true);
 $link = $decoded['paymentUrl'];
 header("Location:$link");
	   

   }

<?php		
#------------------Changes to be done here-----------------------------
	
	# global variables
	$host          = 'localhost'; 
	$mySqlUser     = 'centroz1_flows';          
	$mySqlPassword = '3l3ct1cData!';      
	$mySqlDatabase = 'centroz1_flows';


	//Forget Password FROM DETAILS
	$fromAddress =	'webgod@atomiccoffee.com' ;
	$fromName    =	'Centro'; 

	$path        =  'images/avatar/';


#***********************************************************************

	
	
	try{
		    $db = new PDO("mysql:dbname=$mySqlDatabase;host=$host;",$mySqlUser,$mySqlPassword,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));    		
	    
	    }catch(PDOException $ex){
		  
    		die(json_encode(array('outcome' => false, 'message' => 'Database connection failed')));   
		}


	#image resize function
	function resize($target, $w, $h, $ext) 
	{
    	list($w_orig, $h_orig) = getimagesize($target);
    	/*$scale_ratio = $w_orig / $h_orig;
    	if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    	}
    	else 
    	{
           $h = $w / $scale_ratio;
   		 }*/
    	$img = "";
    	$ext = strtolower($ext);
    	if ($ext == "gif")
    	{ 
      		$img = imagecreatefromgif($target);
    	}
    	else if($ext =="png")
		{ 
      		$img = imagecreatefrompng($target);
    	}
    	else
    	{ 
      		$img = imagecreatefromjpeg($target);
    	}
    	$tci = imagecreatetruecolor($w, $h);
    	// imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    	imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    	imagejpeg($tci, $target, 80);
	}

  

?>
<?php
	function whichToShow(){	
	// Set timezone to UTC
	date_default_timezone_set('UTC');	
	$array = array();
    $day = date("z");
	$adv = fstAdv();

	for($i=1;$i<=4;$i++){
		if($day >= $adv)
		   $array[$i] = 1;
		else
		   $array[$i] = 0;
		$adv += 7;
		}

	return $array;
}

	function fstAdv(){
		$christmas = 357 + date("L");
        $daysTillSunday = date('w', $christmas);
        $adv = $christmas -$daysTillSunday - 21;
        return $adv;
	}
?>

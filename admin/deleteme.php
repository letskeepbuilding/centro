<?
$hearAbout[] = 1;
$hearAbout[] = 2;
$hearAbout[] = 3;
$hearAbout[] = 4;

echo "1";

if(isset($hearAbout)) {
	$chk = "";
	for($i = 0; $i < count($hearAbout); $i++){
		if($i == (count($hearAbout) - 1)){
			$chk .= $hearAbout[$i];
		} else {
			$chk .= $hearAbout[$i].",";
		}
	}
}
echo $chk;
?>
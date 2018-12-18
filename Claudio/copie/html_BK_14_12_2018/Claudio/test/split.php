<?php 
	echo "Ciao, sono uno script PHP! \n"; 
$key =  "hypertext|language, programming";
$keywords = preg_split("/[|]+/", $key);
echo $keywords[0];
echo "\n";
echo $keywords[1];
echo "\n";
$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
echo $keywords[0];
echo "\n";
echo $keywords[1];
echo "\n";
echo $keywords[2];
echo "\n";
$email= "jlrough@yahoo.com";
echo $email;
echo "\n";
$arr = preg_split("/[@]+/",$email);
echo $arr[0];
echo "\n";
echo $arr[1];
echo "\n";
	echo "Dopo, sono uno script PHP! \n"; 
?>

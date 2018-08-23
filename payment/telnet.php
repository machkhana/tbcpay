<?php
$socket = fsockopen("securepay.ufc.ge", "18443", $errno, $errstr); 

if($socket) 
{ 
    echo "Connected <br /><br />"; 
} 
else 
{ 
    echo "Connection failed!<br /><br />"; 
} 

fputs($socket, "help \r\n"); 

$buffer = ""; 

while(!feof($socket)) 
{ 
    $buffer .=fgets($socket, 4096); 
} 

print_r($buffer); 
echo "<br /><br /><br />"; 
/* var_dump($buffer); */

fclose($socket); 
?> 

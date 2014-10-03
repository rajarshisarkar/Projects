<?php
/*
$con = oci_connect('system', '15011994', 'localhost/orcl');
if (!$con) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
*/

$con = @oci_connect('cmms', 'cmms320', '//10.151.7.132/orcl.sail-rdcis.com');
if($con=='')
{
	# $con = @oci_connect('Portal', 'horizon', '//128.100.5.237/orcl.sail-rdcis.com');
	$con = @oci_connect('cmms', 'cmms320', '//10.151.7.131/orcl.sail-rdcis.com');
}

while(!$con) 
{  
  for ($i=1;$i<10;$i++){
  #$con = @oci_connect('Portal', 'horizon', '//128.100.5.239/orcl.sail-rdcis.com');
  $con = @oci_connect('cmms', 'cmms320', '//10.151.7.132/orcl.sail-rdcis.com');
  if($con) { break; }
  else { $i = $i + 1; }
  } // end of for loop
} // end of while loop

if (!$con) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
} 
?>
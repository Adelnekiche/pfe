<?php
function token ($str=25){
  $strng="qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
  $token="";
  for($i=0;$i<=$str-1;$i++)
  {
    $token.=$strng[rand(0,strlen($strng)-1)];
  }
  return $token;


}
 $token=token(30);

?>
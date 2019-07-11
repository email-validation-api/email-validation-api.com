# email-validation-api.com

Easy to use PHP Class implementing our API service to obtain Email address Verification

Download the PHP Class and copy the file into your project directory

Get your Free API Key by following this link: https://email-validation-api.com/email-validation-api-register-0.html

Use the following exemple of code to verify Email addresses:

```
<?php 

include 'MasterClass_email-validation-api.com.php';

$APIKey = 'fe756f39d76fe0633892ee7d43e7dc9a';




$validation = new emailvalidationapi($APIKey, 'json', 'jeancharles@hotmail.com');
$jsonResult = $validation->performRequest();

$arrayResult = json_decode($jsonResult, true);

echo '<h2>JSON API result:</h2>';
echo $jsonResult.'<br/><br/>';

echo '<h2>API result in a table:</h2>';
echo '<table border="1"><tr><td><b>Field</b></td><td><b>Value</b></td></tr>';
foreach( $arrayResult as $k=>$v ){
	echo '<tr><td>'.$k.'</td><td>';
	if( is_array($v) ){
		foreach( $v as $host=>$ports ){
			foreach($ports as $port){
				echo $host.':'.$port.'<br/>';
			}
		}
	}elseif( is_bool($v) ){
		echo '<i>'.($v?'true':'false').'</i>';
	}else{
		echo $v;
	}
	echo '</td></tr>';
}
echo '</table>';
?>
```
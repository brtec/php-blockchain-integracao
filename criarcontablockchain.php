<pre><?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('vendor/autoload.php');
$api_code = null;
if(file_exists('code.txt')) {
    $api_code = trim(file_get_contents('code.txt'));
}
$Blockchain = new \Blockchain\Blockchain($api_code);
$Blockchain->setServiceUrl('http://127.0.0.1:3000');
$wallet = $Blockchain->Create->create('senhateste!');
var_dump($wallet);
//print_r($Blockchain->log);
?></pre>
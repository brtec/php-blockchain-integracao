<pre><?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('vendor/autoload.php');
$api_code = null;
if(file_exists('code.txt')) {
    $api_code = trim(file_get_contents('code.txt'));
}
//var_dump($api_code);
$Blockchain = new \Blockchain\Blockchain($api_code);
$Blockchain->setServiceUrl('http://localhost:3000');
// Get Statistics
$stats = $Blockchain->Stats->get();
?><table><?php
foreach ($stats as $key => $value) {
    echo "<tr><td><strong>$key</strong></td><td>$value</td></tr>" . PHP_EOL;
}
?></table><?php
var_dump($stats);
// Output log of activity
var_dump($Blockchain->log);
?></pre>
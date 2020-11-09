<pre>
<?php
//HABILITAR EXIBIÇÃO DE ERROS
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//REQUERIMENTO DA BIBLIOTECA BLOCKCHAIN
require_once('vendor/autoload.php');

//LEITURA DO API KEY NO ARQUIVO ONDE ELA SE ENCONTRA (SERA SUBSTITUIDO POR BANCO DE DADOS)
$api_code = null;
if(file_exists('code.txt')) {
    $api_code = trim(file_get_contents('code.txt'));
}

//ABRE NOVA OPERAÇÃO
$Blockchain = new \Blockchain\Blockchain($api_code);
$Blockchain->setServiceUrl('http://127.0.0.1:3000');

//DADOS DA CARTEIRA PRINCIPAL
$wallet_guid = '2ee47536-a9ba-4839-bbf1-bfdf2f9c6f9d';
$wallet_pass = 'brun091666519';

//VALIDACAO EM CASO DE DADOS VAZIOS
if(is_null($wallet_guid) || is_null($wallet_pass)) {
    echo "Please enter a wallet GUID and password in the source file.<br/>";
    exit;
}

//FAZ AUTENTICACAO COM OS DADOS DA CARTEIRA
$Blockchain->Wallet->credentials($wallet_guid, $wallet_pass);

//RETORNO DE DADOS DA CARTEIRA PRINCIPAL
echo "<b>Carteira Principal:</b> " . $Blockchain->Wallet->getIdentifier() . "" . PHP_EOL;
echo "<b>Saldo Atual:</b> " . $Blockchain->Wallet->getBalance() . "<br />" . PHP_EOL;

//GERA NOVA CARTEIRA PARA RECEBIMENTO
echo "<b>Nova Carteira Criada:</b><br>";
var_dump($Blockchain->Wallet->getNewAddress("CryptoRecept - WalletTest 1 (Jhonathan Pine)"));

//LISTA TODAS AS CARTEIRAS JÁ CRIADAS E OS VALORES RECEBIDOS EM CADA
echo "<b>Todas as Carteiras Criadas:</b><br>";
var_dump($Blockchain->Wallet->getAddresses());


//SCRIPT PARA ENVIAR UM VALOR PARA UMA CARTEIRA
	//ENDERECO DA CARTEIRA DE DESTINO
	$address = null;
	
	// SCRIPT DE ENVIO COM RETORNO EM CASO DE ERRO
	try {
	    // var_dump($Blockchain->Wallet->send($address, "0.001"));
	} catch (\Blockchain\Exception\ApiError $e) {
	    echo $e->getMessage() . '<br />';
	}

//SCRIPT PARA ENVIAR VALORES PARA VARIAS CARTEIRAS
	//ENDERECO DAS CARTEIRAS DE DESTINO E VALORES
	$recipients = array();
	$recipients[$address] = "0.001";
	
	try {
	    // var_dump($Blockchain->Wallet->sendMany($recipients));
	} catch (Blockchain_ApiError $e) {
	    echo $e->getMessage() . '<br />';
	}



print_r($Blockchain->log);

?>
</pre>
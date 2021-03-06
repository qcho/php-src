--TEST--
Test mcrypt_decrypt() function : basic functionality 
--SKIPIF--
<?php 
if (!extension_loaded("mcrypt")) {
	print "skip - mcrypt extension not loaded"; 
}	 
?>
--FILE--
<?php
/* Prototype  : string mcrypt_decrypt(string cipher, string key, string data, string mode, string iv)
 * Description: OFB crypt/decrypt data using key key with cipher cipher starting with iv 
 * Source code: ext/mcrypt/mcrypt.c
 * Alias to functions: 
 */

echo "*** Testing mcrypt_decrypt() : basic functionality ***\n";


// Initialise all required variables
$cipher = MCRYPT_3DES;
$mode = MCRYPT_MODE_ECB;

// tripledes uses keys with exactly 192 bits (24 bytes)
$keys = array(
   '12345678', 
   '12345678901234567890', 
   '123456789012345678901234', 
   '12345678901234567890123456'
);
$data1 = array(
   '0D4ArM3ejyhic9rnCcIW9A==',
   'q0wt1YeOjLpnKm5WsrzKEw==',
   'zwKEFeqHkhlj+7HZTRA/yA==',
   'zwKEFeqHkhlj+7HZTRA/yA=='
);
// tripledes is a block cipher of 64 bits (8 bytes)
$ivs = array(
   '1234', 
   '12345678', 
   '123456789'
);
$data2 = array(
   '+G7nGcWIxigQcJD+2P14HA==',
   '+G7nGcWIxigQcJD+2P14HA==',
   '+G7nGcWIxigQcJD+2P14HA=='
);

echo "\n--- testing different key lengths\n";
for ($i = 0; $i < sizeof($keys); $i++) {
   echo "\nkey length=".strlen($keys[$i])."\n";
   special_var_dump(mcrypt_decrypt($cipher, $keys[$i], base64_decode($data1[$i]), $mode));
}

$key = '123456789012345678901234';  
echo "\n--- testing different iv lengths\n";
for ($i = 0; $i < sizeof($ivs); $i++) {
   echo "\niv length=".strlen($ivs[$i])."\n";
   special_var_dump(mcrypt_decrypt($cipher, $key, base64_decode($data2[$i]), $mode, $ivs[$i]));
}

function special_var_dump($str) {
   var_dump(bin2hex($str));
}  
?>
===DONE===
--EXPECTF--
*** Testing mcrypt_decrypt() : basic functionality ***

--- testing different key lengths

key length=8

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_decrypt_3des_ecb.php on line 43

Warning: mcrypt_decrypt(): Key of size 8 not supported by this algorithm. Only keys of size 24 supported in %s on line %d
string(0) ""

key length=20

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_decrypt_3des_ecb.php on line 43

Warning: mcrypt_decrypt(): Key of size 20 not supported by this algorithm. Only keys of size 24 supported in %s on line %d
string(0) ""

key length=24

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_decrypt_3des_ecb.php on line 43
string(32) "736563726574206d6573736167650000"

key length=26

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_decrypt_3des_ecb.php on line 43

Warning: mcrypt_decrypt(): Key of size 26 not supported by this algorithm. Only keys of size 24 supported in %s on line %d
string(0) ""

--- testing different iv lengths

iv length=4

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_decrypt_3des_ecb.php on line 50
string(32) "a9298896ed1b7335f8f10f7ff6d7a239"

iv length=8

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_decrypt_3des_ecb.php on line 50
string(32) "a9298896ed1b7335f8f10f7ff6d7a239"

iv length=9

Deprecated: Function mcrypt_decrypt() is deprecated in %s%emcrypt_decrypt_3des_ecb.php on line 50
string(32) "a9298896ed1b7335f8f10f7ff6d7a239"
===DONE===

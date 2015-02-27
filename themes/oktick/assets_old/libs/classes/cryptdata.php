<?php
/**
* Encryption / decryption PHP class for symmetric (two-way) ciphers
*/
//exit;
//$encrypted_string = Data::encryptMcrypt($string_to_encrypt);
//$decrypted_string = Data::decryptMcrypt($encrypted_string);

//$encrypted_string = Data::encryptOpenssl($string_to_encrypt);
//$decrypted_string = Data::decryptOpenssl($encrypted_string);

class CryptData{
 		//http://www.synet.sk/php/en/320-benchmarking-symmetric-cyphers-openssl-vs-mcrypt-in-php
    const
        CYPHER = 'MCRYPT_RIJNDAEL_256',
        MODE   = 'OFB',
        SALT   = '7d97dju3*4fv2v8v*1|1';

    /**
    * Encrypt string using mcrypt module
    * @param string $plaintext Text to be encrypted
    * @param string $password User entered password
    */
    public static function encryptMcrypt($plaintext, $password = ''){
        $td = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        $key = self::SALT.trim($password);
        mcrypt_generic_init($td, $key, $iv);
        $crypttext = mcrypt_generic($td, $plaintext);
        mcrypt_generic_deinit($td);
        $crypttext = $iv.$crypttext;
        return $crypttext;
    }
 
    /**
    * Decrypt string using mcrypt module
    * @param string $crypttext Text to be decrypted
    * @param string $password User entered password
    */
    public static function decryptMcrypt($crypttext, $password = ''){
        $td        = mcrypt_module_open(self::CYPHER, '', self::MODE, '');
        $ivsize    = mcrypt_enc_get_iv_size($td);
        $iv        = substr($crypttext, 0, $ivsize);
        $crypttext = substr($crypttext, $ivsize);
        $key = self::SALT.trim($password);
        mcrypt_generic_init($td, $key, $iv);
        return mdecrypt_generic($td, $crypttext);
    }
 
    /**
    * Encrypt string using openSSL module
    * @param string $textToEncrypt
    * @param string $encryptionMethod One of built-in 50 encryption algorithms
    * @param string $secretHash Any random secure SALT string for your website
    * @param bool $raw If TRUE return base64 encoded string
    * @param string $password User's optional password
    */
    public static function encryptOpenssl($textToEncrypt, $encryptionMethod = 'AES-256-CFB', $secretHash = self::SALT, $raw = false, $password = ''){
        $length = openssl_cipher_iv_length($encryptionMethod);
        $iv = substr(md5($password), 0, $length);
        return openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash, $raw, $iv);
    }
 
    /**
    * Decrypt string using openSSL module
    * @param string $textToDecrypt
    * @param string $encryptionMethod One of built-in 50 encryption algorithms
    * @param string $secretHash Any random secure SALT string for your website
    * @param bool $raw If TRUE return base64 encoded string
    * @param string $password User's optional password
    */
    public static function decryptOpenssl($textToDecrypt, $encryptionMethod = 'AES-256-CFB', $secretHash = self::SALT, $raw = false, $password = ''){
        $length = openssl_cipher_iv_length($encryptionMethod);
        $iv = substr(md5($password), 0, $length);
        return openssl_decrypt($textToDecrypt, $encryptionMethod, $secretHash, $raw, $iv);
    }
}


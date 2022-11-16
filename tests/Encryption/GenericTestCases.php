<?php

namespace Kangyasin\CryptAES\Tests\Encryption;

use Kangyasin\CryptAES\Exceptions\UnableToDecrypt;
use PHPUnit\Framework\TestCase;

abstract class GenericTestCases extends TestCase
{
    abstract public function initClass();

    public function additionProvider()
    {
        return array(
            $this->initClass(),
        );
    }

    public function getCryptAES()
    {
        return $this->CryptAES;
    }

    protected function random_iv($CryptAES, $key)
    {
        $plainText = openssl_random_pseudo_bytes(16);

        $cipher  = $CryptAES->encryptPlainTextWithRandomIV($plainText, $key);
        $decoded = $CryptAES->decryptCipherTextWithRandomIV($cipher, $key);

        $this->assertEquals($plainText, $decoded);
    }

    protected function huge_string_random_iv($CryptAES, $key)
    {
        $plainText = openssl_random_pseudo_bytes(16000);

        $cipher  = $CryptAES->encryptPlainTextWithRandomIV($plainText, $key);
        $decoded = $CryptAES->decryptCipherTextWithRandomIV($cipher, $key);

        $this->assertEquals($plainText, $decoded);
    }

    protected function custom_iv($CryptAES, $key)
    {
        $plainText = openssl_random_pseudo_bytes(16);
        $iv               = $CryptAES->generateRandomIV();

        $cipher  = $CryptAES->encrypt($plainText, $key, $iv);
        $decoded = $CryptAES->decrypt($cipher, $key, $iv);

        $this->assertEquals($plainText, $decoded);
    }

    protected function huge_string_custom_iv($CryptAES, $key)
    {
        $plainText = openssl_random_pseudo_bytes(16000);
        $iv               = $CryptAES->generateRandomIV();

        $cipher  = $CryptAES->encryptPlainTextWithRandomIV($plainText, $key, $iv);
        $decoded = $CryptAES->decryptCipherTextWithRandomIV($cipher, $key, $iv);

        $this->assertEquals($plainText, $decoded);
    }

    protected function diff_key_expect_exception($CryptAES, $key)
    {
        $this->expectException(UnableToDecrypt::class);

        $plainText = openssl_random_pseudo_bytes(16);

        $cipher  = $CryptAES->encrypt($plainText, openssl_random_pseudo_bytes(16), $CryptAES->generateRandomIV());
        $decoded = $CryptAES->decrypt($cipher, openssl_random_pseudo_bytes(16), $CryptAES->generateRandomIV());
    }

    protected function huge_string_diff_key_expect_exception($CryptAES, $key)
    {
        $this->expectException(UnableToDecrypt::class);

        $plainText = openssl_random_pseudo_bytes(16000);

        $cipher  = $CryptAES->encrypt($plainText, openssl_random_pseudo_bytes(16), $CryptAES->generateRandomIV());
        $decoded = $CryptAES->decrypt($cipher, openssl_random_pseudo_bytes(16), $CryptAES->generateRandomIV());
    }

}

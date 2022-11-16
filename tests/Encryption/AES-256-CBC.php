<?php

namespace Kangyasin\CryptAES\Tests\Encryption;

class AES_256_CBC_Test extends GenericTestCases
{
    protected $CryptAES;

    public function initClass()
    {
        $secretKey       = openssl_random_pseudo_bytes(16);
        $this->CryptAES = new \Kangyasin\CryptAES\CryptAES([
            'method' => 'AES-256-CBC',
        ]);

        // Do not change this return order.
        return [
            $this->getCryptAES(),
            $secretKey,
        ];
    }

    /**
     * @test
     *
     * @dataProvider additionProvider
     */
    public function random_iv($CryptAES, $key)
    {
        parent::random_iv($CryptAES, $key);
    }

    /**
     * @test
     *
     * @dataProvider additionProvider
     */
    public function huge_string_random_iv($CryptAES, $key)
    {
        parent::huge_string_random_iv($CryptAES, $key);
    }

    /**
     * @test
     *
     * @dataProvider additionProvider
     */
    public function custom_iv($CryptAES, $key)
    {
        parent::custom_iv($CryptAES, $key);
    }

    /**
     * @test
     *
     * @dataProvider additionProvider
     */
    public function huge_string_custom_iv($CryptAES, $key)
    {
        parent::huge_string_custom_iv($CryptAES, $key);
    }

    /**
     * @test
     *
     * @dataProvider additionProvider
     */
    public function diff_key_expect_exception($CryptAES, $key)
    {
        parent::diff_key_expect_exception($CryptAES, $key);
    }

    /**
     * @test
     *
     * @dataProvider additionProvider
     */
    public function huge_string_diff_key_expect_exception($CryptAES, $key)
    {
        parent::huge_string_diff_key_expect_exception($CryptAES, $key);
    }

}

# CryptAES (PHP)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kangyasin/crypt-aes-php.svg?style=flat-square)](https://packagist.org/packages/kangyasin/crypt-aes-php)
[![Total Downloads](https://img.shields.io/packagist/dt/kangyasin/crypt-aes-php.svg?style=flat-square)](https://packagist.org/packages/kangyasin/crypt-aes-php)
[![License](https://poser.pugx.org/kangyasin/crypt-aes-php/license?format=flat-square)](https://packagist.org/packages/kangyasin/crypt-aes-php)


This is the library for encrypting data with a key (password will be generate as per your parameters set) in PHP.

**WHY ANOTHER LIBRARY?** This was intended to developed for cross-platform AES Encryption [here](https://github.com/kangyasin/AES-CrossPlatform) as PHP was missing. My main objective is to create library for `AES-256-CBC` to contribute PHP package for Cross-Platform-AES package, more features will be added whenever I gets time.

### Features

- Support for Random IV (initialization vector) for encryption and decryption. Randomization is crucial for encryption schemes to achieve semantic security, a property whereby repeated usage of the scheme under the same key does not allow an attacker to infer relationships between segments of the encrypted message.
- Support for SHA-256 for hashing the key. Never use plain text as encryption key. Always hash the plain text key and then use for encryption. AES permits the use of 256-bit keys. Breaking a symmetric 256-bit key by brute force requires 2^128 times more computational power than a 128-bit key. A device that could check a billion billion (10^18) AES keys per second would in theory require about 3×10^51 years to exhaust the 256-bit key space.
- PHP-7 Support since `mcrypt` has been deprecated.

## Installation

You can install the package via composer:

```bash
composer require kangyasin/crypt-aes-php
```

## Dependencies

The bindings require the following extensions in order to work properly:

- [`openssl`](https://secure.php.net/manual/en/book.openssl.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Usage

#### With Random IV

``` php
$string     = 'The quick brown fox jumps over to the lazy dog.';
$secretyKey = 'BlVssQKxzAHFAUNZbqvwS+yKw/m';

$encryption = new \Kangyasin\CryptAES\CryptAES();

$cipher  = $encryption->encryptPlainTextWithRandomIV($string, $secretyKey);
echo 'Cipher: ' . $cipher . PHP_EOL;

$plainText = $encryption->decryptCipherTextWithRandomIV($cipher, $secretyKey);
echo 'Decrypted: ' . $plainText . PHP_EOL;
```

#### With Generated IV

``` php
$string     = 'The quick brown fox jumps over to the lazy dog.';
$secretyKey = 'BlVssQKxzAHFAUNZbqvwS+yKw/m';

$encryption = new \Kangyasin\CryptAES\CryptAES();
$iv         = $encryption->generateRandomIV();

$cipher = $encryption->encrypt($string, $secretyKey, $iv);
echo 'Cipher: ' . $cipher . PHP_EOL;

$plainText = $encryption->decrypt($cipher, $secretyKey, $iv);
echo 'Decrypted: ' . $plainText . PHP_EOL;
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tutorialblogmarine@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

<?php

use Illuminate\Support\Facades\Crypt;

/**
 * Encrypt a value for use in a URL.
 *
 * @param string $value
 * @return string
 */
function encrypt_url($value)
{
    return Crypt::encryptString($value);
}

/**
 * Decrypt a value from a URL.
 *
 * @param string $encrypted
 * @return string|null
 */
function decrypt_url($encrypted)
{
    try {
        return Crypt::decryptString($encrypted);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return null; // Or handle as needed
    }
}

<?php

namespace Src\Domain\Authentication;

use Src\Domain\Shared\ValueObject\StringValueObject;

class JwtToken extends StringValueObject
{
    /**
     * Transforms a payload into a JWT token.
     *
     * @param User $user
     * @param array $payload
     * @return string
     */
    public static function generate(array $payload = []): string
    {
        $headers_encoded = self::base64urlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload_encoded = self::base64urlEncode(json_encode($payload));

        // TODO Check secrets
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", config('APP_KEY'), true);
        $signature_encoded = self::base64urlEncode($signature);

        return "$headers_encoded.$payload_encoded.$signature_encoded";
    }

    /**
     * Returns the string encoded in base 64.
     *
     * @param string $chain
     * @return string
     */
    private static function base64urlEncode(string $chain): string
    {
        return rtrim(strtr(base64_encode($chain), '+/', '-_'), '=');
    }
}

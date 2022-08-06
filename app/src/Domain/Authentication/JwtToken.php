<?php

namespace Src\Domain\Authentication;

use Src\Domain\Authentication\Exceptions\InvalidTokenException;
use Src\Domain\Shared\ValueObject\StringValueObject;

class JwtToken extends StringValueObject
{
    private array $content;

    public function __construct(string $value)
    {
        parent::__construct($value);

        $tokenParts = explode('.', $this->value);
        if (count($tokenParts) !== 3)
            throw new InvalidTokenException();

        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        $expiration = json_decode($payload)->exp;
        $is_token_expired = ($expiration - time()) < 0;

        $base64_url_header = $this->base64urlEncode($header);
        $base64_url_payload = $this->base64urlEncode($payload);
        $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, config('app.key'), true);
        $base64_url_signature = $this->base64urlEncode($signature);

        // $BlacklistedTokens = TableRegistry::getTableLocator()->get('BlacklistedTokens');
        // $not_expired = $BlacklistedTokens->findByToken($jwt)->count() === 0;
        // if ($BlacklistedTokens->findByToken($jwt)->count() !== 0) throw new BadRequestException("Token blacklisté");

        if ($is_token_expired)
            throw new InvalidTokenException('You are disconnected');

        // if (!$not_expired)
        //     throw new InvalidTokenException('You have been disconnected, you must reconnect.');

        if (($base64_url_signature !== $signature_provided))
            throw new InvalidTokenException();

        $this->content = json_decode($payload, true);
    }

    /**
     * Transforms a payload into a JWT token.
     *
     * @param User $user
     * @param array $payload
     * @return string
     */
    public static function generate(array $payload = []): string
    {
        $payload['exp'] = time() + 3600;
        $headers_encoded = self::base64urlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload_encoded = self::base64urlEncode(json_encode($payload));

        // TODO Check secrets
        $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", config('app.key'), true);
        $signature_encoded = self::base64urlEncode($signature);

        return "$headers_encoded.$payload_encoded.$signature_encoded";
    }

    /**
     * Checks if a field exists in the token.
     *
     * @param string $field
     * @return bool
     */
    public function hasField(string $field): bool
    {
        return isset($this->content[$field]);
    }

    /**
     * Checks if a field exists in the token.
     *
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    public function hasAFieldThatIs(string $field, $value): bool
    {
        if (!isset($this->content[$field]))
            return false;

        return $this->content[$field] === $value;
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

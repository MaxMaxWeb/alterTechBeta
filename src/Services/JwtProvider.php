<?php


namespace App\Services;


use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha384;

class JwtProvider
{
    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function __invoke(): string
    {
        return (new Builder())
            ->set('mercure', ['publish' => ['*']])
            ->sign(new Sha384(), $this->secret)
            ->getToken();
    }
}
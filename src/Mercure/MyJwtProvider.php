<?php
namespace App\Mercure;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

final class MyJwtProvider
{
private $secret;

public function __construct(string $secret)
{
$this->secret = $secret;
}

public function __invoke(): string
{
return (new Builder())
->withClaim('mercure', ['publish' => ['*']])
->getToken(new Sha256(), new Key($this->secret));
}
}
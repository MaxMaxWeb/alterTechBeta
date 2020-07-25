<?php


namespace App\Mercure;





use Symfony\Component\HttpFoundation\Request;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\WebLink\Link;

final class MercureCookiesGenerator
{
    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function generate(): Cookie
    {
        $token = (new Builder())
            ->withClaim('mercure', ['subscribe' => ['*']])
            ->getToken(new Sha256(), new Key($this->secret));

        return Cookie::create('mercureAuthorization', $token, 0, '/.well-known/mercure');
    }


}
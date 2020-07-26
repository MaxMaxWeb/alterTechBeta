<?php


namespace App\Services;




use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha384;

class MercureCookieGenerator
{
    /**
     * @var string
     */
    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function generate(){
        $token = (new Builder())
            ->set('mercure', ['subscribe' => ['*']])
            ->sign(new Sha384(), $this->secret)
            ->getToken();
        return "mercureAuthorization={$token};Path=/hub;HttpOnly;secure";


    }
}
<?php

namespace Thitami\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;

/**
 * Class DailyMotion
 * @package App\Provider
 */
class DailyMotionResourceOwner implements ResourceOwnerInterface
{
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Token
     *
     * @var AccessToken
     */
    protected $token;

    /**
     * DailyMotionResourceOwner constructor.
     *
     * @param array $response
     * @param AccessToken $token
     */
    public function __construct(array $response, AccessToken $token)
    {
        $this->response = $response;
        $this->token = $token;
    }

    /**
     * @return bool|string
     */
    public function getId()
    {
        $uri = $this->response['uri'];

        return substr($uri, strrpos($uri, '/') + 1);
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }

}

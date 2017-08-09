<?php

namespace Thitami\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;

/**
 * Class DailyMotionResourceOwner
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
        return $this->response['data']['id'] ?: null;
    }

    /**
     * @return bool|string
     */
    public function getScreenName()
    {
        return $this->response['data']['screenname'] ?: null;
    }

    /**
     * @return bool|string
     */
    public function getDescription()
    {
        return $this->response['data']['description'] ?: null;
    }

    /**
     * @return bool|string
     */
    public function getProfileUrl()
    {
        return $this->response['data']['url'] ?: null;
    }

    /**
     * Get the token scope
     *
     * @return string|null
     */
    public function getTokenScope()
    {
        $values = $this->token->getValues();
        return empty($values['scope']) ? null : $values['scope'];
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

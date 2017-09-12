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
        return $this->response['id'] ?: null;
    }

    /**
     * @return bool|string
     */
    public function getScreenName()
    {
        return $this->response['screenname'] ?: null;
    }

    /**
     * Get resource owner's username
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->response['username'] ?: null;
    }

    /**
     * Get resource owner's image url
     *
     * @return string|null
     */
    public function getAvatar()
    {
        // @todo
    }

    /**
     * @return bool|string
     */
    public function getUserName()
    {
        return $this->response['description'] ?: null;
    }

    /**
     * @return bool|string
     */
    public function getProfileUrl()
    {
        return $this->response['url'] ?: null;
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

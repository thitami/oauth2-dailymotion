<?php

namespace Thitami\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * Class DailyMotion
 * @package App\Provider
 */
class DailyMotion extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @inheritdoc
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://www.dailymotion.com/oauth/authorize';
    }

    /**
     * @inheritdoc
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://api.dailymotion.com/oauth/token';
    }

    /**
     * @inheritdoc
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://api.dailymotion.com/auth';
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultScopes()
    {
        return ['public'];
    }

    /**
     * @param ResponseInterface $response
     * @param array|string $data
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (!empty($data['error'])) {
            $error = isset($data['error']['message']) ? $data['error']['message'] : '';
            $code = isset($data['error']['code']) ? intval($data['error']['code']) : 0;
            throw new IdentityProviderException($error, $code, $data);
        }
    }

    /**
     * @param array $response
     * @param AccessToken $token
     *
     * @return DailyMotionResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new DailyMotionResourceOwner($response, $token);
    }

}
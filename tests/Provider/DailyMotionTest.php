<?php

namespace Thitami\OAuth2\Client\Test\Provider;

use App\Provider\DailyMotion;
use \Mockery as m;

class DailyMotionTest extends \PHPUnit_Framework_TestCase {

    protected $provider;

    protected function setUp()
    {
        $this->provider = new DailyMotion([
            'clientId' => 'mock',
            'clientSecret' => 'mock_secret',
            'redirectUri' => 'none',
        ]);
    }

    public function testAuthorizationUrl()
    {
        $url = $this->provider->getAuthorizationUrl();
        $uri = parse_url($url);
        parse_str($uri['query'], $query);

        $this->assertArrayHasKey('client_id', $query);
        $this->assertArrayHasKey('redirect_uri', $query);
        $this->assertArrayHasKey('state', $query);
        $this->assertArrayHasKey('scope', $query);
        $this->assertArrayHasKey('response_type', $query);
        $this->assertArrayHasKey('approval_prompt', $query);
        $this->assertNotNull($this->provider->state);
    }

    public function testUrlAccessToken()
    {
        $url = $this->provider->urlAccessToken();
        $uri = parse_url($url);

        $this->assertEquals('/oauth2/access', $uri['path']);
    }

    public function testGetAccessToken()
    {
        $response = m::mock('Guzzle\Http\Message\Response');
        $response->shouldReceive('getBody')->times(1)->andReturn('{"access_token": "mock_access_token", "expires_in": 3600, "refresh_token": "mock_refresh_token", "token_type": "bearer"}');

        $client = m::mock('Guzzle\Service\Client');
        $client->shouldReceive('setBaseUrl')->times(1);
        $client->shouldReceive('post->send')->times(1)->andReturn($response);
        $this->provider->setHttpClient($client);

        $token = $this->provider->getAccessToken('authorization_code', array('code' => 'mock_authorization_code'));

        $this->assertEquals('mock_access_token', $token->accessToken);
        $this->assertLessThanOrEqual(time() + 3600, $token->expires);
        $this->assertGreaterThanOrEqual(time(), $token->expires);
        $this->assertEquals('mock_refresh_token', $token->refreshToken);
    }

    public function testScopes()
    {
        $this->assertEquals(array(), $this->provider->getScopes());
    }

    public function testUserData()
    {
        $userInfo = 'testUserInfo test data';
        $postResponse = m::mock('Guzzle\Http\Message\Response');
        $postResponse->shouldReceive('getBody')->times(1)->andReturn('{"access_token": "mock_access_token", "expires": 3600, "refresh_token": "mock_refresh_token", "token_type": "bearer"}');

        $getResponse = m::mock('Guzzle\Http\Message\Response');
        $getResponse->shouldReceive('getBody')->times(1)->andReturn($userInfo);

        $client = m::mock('Guzzle\Service\Client');
        $client->shouldReceive('setBaseUrl')->times(1);
        $client->shouldReceive('post->send')->times(1)->andReturn($postResponse);
        $client->shouldReceive('get->send')->times(1)->andReturn($getResponse);
        $this->provider->setHttpClient($client);

        $token = $this->provider->getAccessToken('authorization_code', array('code' => 'mock_authorization_code'));
        $user = $this->provider->getUserDetails($token);

        $this->assertEquals(123456, $this->provider->getUserUid($token));
        $this->assertEquals(123456, $user->uid);
        $this->assertEquals("fake name" , $this->provider->getUserScreenName($token));
        $this->assertEquals("mock-photo-url", $user->imageUrl);
        $this->assertEquals("mock bio", $user->description);
        $this->assertEquals(null, $user->email);
    }
}
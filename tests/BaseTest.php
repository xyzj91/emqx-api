<?php
declare(strict_types=1);

namespace EMQXAPITests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use EMQX\API\EMQXClient;

abstract class BaseTest extends TestCase
{
    /**
     * @var string
     */
    protected string $uri;
    /**
     * @var string
     */
    protected string $appid;
    /**
     * @var string
     */
    protected string $appsecret;
    /**
     * @var EMQXClient
     */
    protected EMQXClient $client;
    /**
     * @var string
     */
    protected string $node;
    /**
     * @var string
     */
    protected string $topic;
    /**
     * @var string
     */
    protected string $key;
    /**
     * @var string
     */
    protected string $clientid;

    /**
     * setUp
     */
    public function setUp(): void
    {
        $this->uri = env('EMQ_URI','');
        $this->appid = env('EMQ_APPID','');
        $this->appsecret = env('EMQ_APPSECRET','');
        $this->node = env('EMQ_NODE','');
        $this->topic = env('EMQ_TOPIC','');
        $this->key = env('EMQ_KEY','');
        $this->clientid = env('EMQ_CLIENTID','');
        $client = new Client([
            'base_uri' => $this->uri,
            'auth' => [$this->appid, $this->appsecret],
            'timeout' => 30.0,
            'debug' => false,
            'verify' => true,
            'version' => env('EMQ_HTTP_VERSION') ? (float)env('EMQ_HTTP_VERSION') : 1.1
        ]);
        $this->client = new EMQXClient($client);
    }
}
<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Dmitry Shumytskyi <d.shumytskyi@gmail.com>
 */
class PackageControllerTest extends WebTestCase
{
    /**
     * @class createClient
     */
    public $client;
    /**
     * @var array
     */
    public $metadata;
    /**
     * @var string
     */
    public $testContent = '{"args":{"location":"39.6034810,-119.6822510","timestamp":"1331161200"}}';

    public function setUp()
    {
        $this->client = static::createClient();

        self::bootKernel();

        $this->metadata = static::$kernel->getContainer()
            ->getParameter('app_bundle.metadata');
    }

    public function testAllFunctionsOnSucceededRequest()
    {
        foreach ($this->metadata['blocks'] as $key => $blockName)
        {
            $this->client->request(
                'POST',
                '/api/GoogleTimezoneAPI/' . $blockName['name'],
                [],
                [],
                [],
                $this->testContent
            );

            $response = $this->client->getResponse();

            $this->assertEquals(200, $response->getStatusCode());
        }
    }

    public function testMetadata()
    {
        $this->client->request('GET', '/api/GoogleTimezoneAPI');
        $response = $this->client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertJson($response->getContent());
        $this->assertArrayHasKey('package', $data);
        $this->assertArrayHasKey('tagline', $data);
        $this->assertArrayHasKey('description', $data);
        $this->assertArrayHasKey('image', $data);
        $this->assertArrayHasKey('repo', $data);
        $this->assertArrayHasKey('accounts', $data);
        $this->assertArrayHasKey('blocks', $data);
        $this->assertEquals('GoogleTimezoneAPI', $data['package']);
    }

}
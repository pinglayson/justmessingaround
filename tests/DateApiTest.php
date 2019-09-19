<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class DateApiTest extends TestCase
{
    private $http;

    public function setUp()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://justmessingaround.test/']);
    }

    public function testCanCalculateBetweenDays()
    {
        $response = $this->http->request(
            'GET',
            'api/v1/between',
            [
                'query' => [
                    'from' => '2019-09-18 06:57:44',
                    'to' => '2019-09-01 06:57:44',
                    'format' => 'days'
                ]
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody());
        $this->assertEquals(17, $data->data);
    }

    public function testCanCalculateBetweenWeeks()
    {
        $response = $this->http->request(
            'GET',
            'api/v1/between',
            [
                'query' => [
                    'from' => '2019-09-18 06:57:44',
                    'to' => '2019-09-01 06:57:44',
                    'format' => 'weeks'
                ]
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody());
        $this->assertEquals(2, $data->data);
    }

    public function testCanCalculateBetweenDaysWithTimezone()
    {
        $response = $this->http->request(
            'GET',
            'api/v1/between',
            [
                'query' => [
                    'from' => '2019-09-18 06:57:44',
                    'to' => '2019-09-01 06:57:44',
                    'format' => 'days',
                    'to_tz' => 'America/Sitka'
                ]
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody());
        $this->assertEquals(16, $data->data);
    }

    public function testWrongFormat()
    {
        $response = $this->http->request(
            'GET',
            'api/v1/between',
            [
                'query' => [
                    'from' => '2019-09-18 06:57:44',
                    'to' => '2019-09-01 06:57:44',
                    'format' => 'daysss',
                    'to_tz' => 'America/Sitka'
                ]
            ]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody());
        $this->assertRegexp('/Allowable format values/', $data->msg);
    }
}

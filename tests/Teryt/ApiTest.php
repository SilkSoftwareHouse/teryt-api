<?php
/**
 * TERYT-API
 *
 * Copyright (c) 2017 pudelek.org.pl
 *
 * @license MIT License (MIT)
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * @author Marcin Pudełek <marcin@pudelek.org.pl>
 *
 */

/**
 * Created by Marcin.
 * Date: 09.09.2017
 * Time: 20:12
 */

namespace silksoftwarehouse\Teryt;

use silksoftwarehouse\Teryt\Model\City;
use silksoftwarehouse\Teryt\Model\Commune;
use silksoftwarehouse\Teryt\Model\District;
use silksoftwarehouse\Teryt\Model\Province;

class ApiTest extends TestCase
{
    /**
     * @var \silksoftwarehouse\Teryt\Api
     */
    private $oApi;
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $oClient    = new \silksoftwarehouse\Teryt\Client();
        $this->oApi = new Api($oClient);
    }

    public function testGetCity()
    {
        $oResp      = $this->oApi->getCity('0700884');

        $this->assertInstanceOf(City::class, $oResp);
        $this->assertEquals(true,isset($oResp->commune));
        $this->assertInstanceOf(Commune::class, $oResp->commune);
        $this->assertEquals(true,isset($oResp->commune->district));
        $this->assertInstanceOf(District::class, $oResp->commune->district);
        $this->assertEquals(true,isset($oResp->commune->district->province));
        $this->assertInstanceOf(Province::class, $oResp->commune->district->province);
    }

    /**
     * @expectedException \silksoftwarehouse\Teryt\Exception\NotFound
     */
    public function testGetCityNotFound()
    {
        $oResp      = $this->oApi->getCity('0700884000000');

    }

}

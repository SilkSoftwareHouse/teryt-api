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
 * @author  Marcin Pudełek <marcin@pudelek.org.pl>
 *
 */

/**
 * Created by Marcin.
 * Date: 09.09.2017
 * Time: 14:42
 */

namespace silksoftwarehouse\Teryt;

class ConnectionTest extends TestCase
{
    public function testConnect()
    {
        $oClient    = new \silksoftwarehouse\Teryt\Client();
        $oNativeApi = NativeApi::create($oClient);
        $this->assertEquals(true, $oNativeApi->CzyZalogowany());
    }

    /**
     * @expectedException \silksoftwarehouse\Teryt\Exception\Connection
     */
    public function testInvalidAuth()
    {
        $oClient = new \silksoftwarehouse\Teryt\Client();
        $oClient->setConfig('invaliduser', 'invalidpassword',false);
        $oNativeApi = NativeApi::create($oClient);
        $oNativeApi->PobierzListeWojewodztw();
    }
}

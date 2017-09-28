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

namespace silksoftwarehouse\Teryt;

use silksoftwarehouse\Teryt\Model\City;


/**
 * Class Api
 *
 * @package silksoftwarehouse\Teryt
 */
class Api
{
    /**
     * @var NativeApi
     */
    private $oNativeApi;

    /**
     * Api constructor.
     *
     * @param Client $oClient
     */
    public function __construct(Client $oClient)
    {
        $this->oNativeApi = NativeApi::create($oClient);
    }

    /**
     * Get information about City
     *
     * @param string $id
     *
     * @return City
     */
    public function getCity($id)
    {
        $oCity = new City();

        return $oCity->find($id);
    }

}

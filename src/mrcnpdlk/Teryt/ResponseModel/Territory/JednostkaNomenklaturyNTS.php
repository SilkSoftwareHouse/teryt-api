<?php
/**
 * TERYT-API
 *
 * Copyright (c) 2017 pudelek.org.pl
 *
 * For the full copyright and license information, please view source file
 * that is bundled with this package in the file LICENSE
 *
 * Author Marcin Pudełek <marcin@pudelek.org.pl>
 *
 */

/**
 * Created by Marcin Pudełek <marcin@pudelek.org.pl>
 * Date: 06.09.2017
 */

namespace mrcnpdlk\Teryt\ResponseModel\Territory;

/**
 * Class JednostkaNomenklaturyNTS
 *
 * @package mrcnpdlk\Teryt\ResponseModel\Territory
 */
class JednostkaNomenklaturyNTS extends AbstractResponseModel
{
    /**
     * Jednoznakowy symbol poziomu
     *
     * @var string
     */
    public $level;
    /**
     * Jednoznakowy symbol regionu
     *
     * @var string
     */
    public $region;
    /**
     * Dwuznakowy symbol podregionu
     *
     * @var string
     */
    public $subregion;
    /**
     * Nazwa jednostki
     *
     * @var string
     */
    public $name;
    /**
     * Typ jednostki podziału terytorialnego
     *
     * @var string
     */
    public $typeName;
}

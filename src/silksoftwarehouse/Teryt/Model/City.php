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
 * Created by Marcin Pudełek <marcin@pudelek.org.pl>
 * Date: 07.09.2017
 */

namespace silksoftwarehouse\Teryt\Model;


use silksoftwarehouse\Teryt\Exception\NotFound;
use silksoftwarehouse\Teryt\NativeApi;

/**
 * Class City
 *
 * @package silksoftwarehouse\Teryt\Model
 */
class City extends EntityAbstract
{
    /**
     * 7 znakowy identyfikator miejscowości
     *
     * @var string
     */
    public $id;
    /**
     * 7 znakowy identyfikator miejscowości nadrzędnej
     *
     * @var string
     */
    public $parentId;
    /**
     * Symbol rodzaju miejscowości
     *
     * @var string
     */
    public $rmId;
    /**
     * Nazwa rodzaju miejscowości
     *
     * @var string
     */
    public $rmName;
    /**
     * Nazwa miejscowości
     *
     * @var static
     */
    public $name;
    /**
     * Obiekt z danymi o gminie w której znajduje się miasto/miejscowość
     *
     * @var \silksoftwarehouse\Teryt\Model\Commune
     */
    public $commune;


    /**
     * @param string $id
     *
     * @return \silksoftwarehouse\Teryt\Model\City
     * @throws NotFound
     */
    public function find($id)
    {
        $res = NativeApi::getInstance()->WyszukajMiejscowoscWRejestrze(null, $id);
        if (!empty($res) && count($res) === 1) {
            $oCity          = $res[0];
            $this->id       = $id;
            $this->parentId = $oCity->cityParentId;
            $this->name     = $oCity->cityName;
            $this->rmId     = $oCity->rmId;
            $this->rmName   = $oCity->rmName;
            $this->commune  = (new Commune())->find($oCity->tercId);
        }

        if (!$this->id) {
            throw new NotFound(sprintf('City [id:%s] not exists', $id));
        }

        return $this;
    }
}

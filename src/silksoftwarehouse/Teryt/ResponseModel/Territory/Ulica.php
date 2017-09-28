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
 * Date: 06.09.2017
 */

namespace silksoftwarehouse\Teryt\ResponseModel\Territory;

/**
 * Class Ulica
 *
 * @package silksoftwarehouse\Teryt\ResponseModel\Territory
 */
class Ulica extends AbstractResponseModel
{
    /**
     * Zawiera cechę ulicy
     *
     * @var string
     */
    public $streetIdentity;
    /**
     * Nazwa ulicy
     *
     * @var string
     */
    public $streetName;
    /**
     * Identyfikator ulicy
     *
     * @var string
     */
    public $streetId;
    /**
     * 7 znakowy identyfikator miejscowości
     *
     * @var string
     */
    public $cityId;
    /**
     * Nazwa ulicy
     *
     * @var string
     */
    public $cityName;

    /**
     * Ulica constructor.
     *
     * @param \stdClass|null $oData Obiekt zwrócony z TerytWS1
     */
    public function __construct(\stdClass $oData = null)
    {
        if ($oData) {
            $this->streetIdentity = $oData->Cecha;
            $this->communeTypeId  = isset($oData->GmiRodzaj) ?: isset($oData->RodzGmi) ?: null;
            $this->communeTypeId  = isset($oData->GmiRodzaj) ?: isset($oData->RodzGmi) ?: null;
            $this->communeId      = isset($oData->GmiSymbol) ?: isset($oData->Gmi) ?: null;
            $this->communeName    = isset($oData->Gmina) ?: null;
            $this->cityId         = isset($oData->IdentyfikatorMiejscowosci);
            $this->streetId       = isset($oData->IdentyfikatorUlicy) ?: isset($oData->SymbolUlicy) ?: null;
            $this->streetName     = isset($oData->Nazwa) ?: null;
            $this->cityName       = isset($oData->NazwaMiejscowosci) ?: null;
            $this->districtId     = isset($oData->PowSymbol) ?: isset($oData->Pow) ?: null;
            $this->districtName   = isset($oData->Powiat) ?: null;
            $this->provinceId     = isset($oData->WojSymbol) ?: isset($oData->Woj) ?: null;
            $this->provinceName   = isset($oData->Wojewodztwo) ?: null;

            $dataStanu = isset($oData->DataStanu) ?: isset($oData->StanNa) ?: null;
            try {
                $this->statusDate = $dataStanu ? (new \DateTime($dataStanu))->format('Y-m-d') : null;
            } catch (\Exception $e) {
                $this->statusDate = null;
            }
        }

        parent::__construct();
    }
}

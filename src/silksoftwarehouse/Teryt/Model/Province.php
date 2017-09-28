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


use silksoftwarehouse\Teryt\Exception;
use silksoftwarehouse\Teryt\NativeApi;

/**
 * Class Province
 *
 * @package silksoftwarehouse\Teryt\Model
 */
class Province extends EntityAbstract
{
    /**
     * Dwuznakowy symbol województwa
     *
     * @var string
     */
    public $id;
    /**
     * Nazwa województwa
     *
     * @var static
     */
    public $name;

    /**
     * Province constructor.
     *
     * @param string $id Dwuznakowy symbol województwa
     *
     * @return $this
     * @throws Exception\NotFound
     */
    public function find($id)
    {
        foreach (NativeApi::getInstance()->PobierzListeWojewodztw() as $w) {
            if ($w->provinceId === $id) {
                $this->id   = $w->provinceId;
                $this->name = $w->name;
            }
        }
        if (!$this->id) {
            throw new Exception\NotFound(sprintf('Province [id:%s] not exists', $id));
        }

        return $this;
    }


    /**
     * Pełnokontekstowe wyszukiwanie powiatów w województwie
     *
     * @param string|null $phrase Szukana fraza, gdy NULL zwraca wszystkie powiaty w województwie
     *
     * @return \silksoftwarehouse\Teryt\Model\District[]
     * @throws \Exception
     */
    public function searchDistricts($phrase = null)
    {
        try {
            $answer = [];
            if ($phrase) {
                $tList = NativeApi::getInstance()->WyszukajJednostkeWRejestrze($phrase, NativeApi::CATEGORY_POW_ALL);
                foreach ($tList as $p) {
                    if ($p->provinceId === $this->id) {
                        $answer[] = (new District())->find($p->provinceId . $p->districtId);
                    }
                }
            } else {
                $tList = NativeApi::getInstance()->PobierzListePowiatow($this->id);
                foreach ($tList as $p) {
                    $answer[] = (new District())->find($p->provinceId . $p->districtId);
                }
            }

            return $answer;

        } catch (Exception\NotFound $e) {
            return [];
        } catch (\Exception $e) {
            throw $e;
        }
    }
}



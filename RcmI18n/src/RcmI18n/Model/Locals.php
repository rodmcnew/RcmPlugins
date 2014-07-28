<?php

namespace RcmI18n\Model;

use Rcm\Service\SiteManager;


/**
 * Locales
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\Model
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class Locales
{
    protected $locales;

    /**
     * Constructor
     *
     * @param SiteManager $siteManager Rcm Site Manager
     */
    function __construct(SiteManager $siteManager)
    {
        $list = [];
        foreach ($siteManager->getAllActiveSites() as $site) {
            $list[] = $site->getLanguage()->getIso6391()
                . '_' . $site->getCountry()->getIso2();
        }
        $this->locales = array_values(array_unique($list));
    }

    /**
     * Returns all locales used by active sites
     *
     * @return array
     */
    function getLocales()
    {
        return $this->locales;
    }

    /**
     * Returns true if locale is valid
     *
     * @param $locale
     *
     * @return boolean
     */
    function localeIsValid($locale)
    {
        return in_array($locale, $this->getLocales());
    }
} 
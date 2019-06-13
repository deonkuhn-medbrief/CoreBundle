<?php

namespace MedBrief\CoreBundle\Twig;

use Symfony\Component\Intl\Intl;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class MedBriefUrlizeExtension
 *
 * Registers a custom filter called urlize which replaces URLs in plan text
 * with clickable links
 *
 * @package MedBrief\CoreBundle\Twig
 */
class MedBriefCountryNameExtension extends AbstractExtension
{

    public function getFilters()
    {
        return array(
            
            new TwigFilter('countryName', array($this, 'countryNameFilter')),
        );
    }

    /**
     * a custom filter called urlize which replaces URLs in plain text
     * with clickable links
     *
     * @param string $countryCode
     *
     * @return null | string
     */
    public function countryNameFilter($countryCode){
        return Intl::getRegionBundle()->getCountryName($countryCode);
    }
}

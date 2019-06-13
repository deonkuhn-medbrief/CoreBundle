<?php

namespace MedBrief\CoreBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Intl\Intl;

/**
 * Class MedBriefUrlizeExtension
 *
 * Registers a custom filter called urlize which replaces URLs in plan text
 * with clickable links
 *
 * @package MedBrief\CoreBundle\Twig
 */
class MedBriefCountryNameExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            
            new \Twig_SimpleFilter('countryName', array($this, 'countryNameFilter')),
        );
    }

    /**
     * a custom filter called urlize which replaces URLs in plan text
     * with clickable links
     *
     * @param $string
     * @return mixed
     */
    public function countryNameFilter($countryCode){
        return Intl::getRegionBundle()->getCountryName($countryCode);
    }


    public function getName()
    {
        return 'mb_country_name_extension';
    }
}

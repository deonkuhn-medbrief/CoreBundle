<?php

namespace MedBrief\CoreBundle\Twig;

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
class MedBriefUrlizeExtension extends AbstractExtension
{

    public function getFilters()
    {
        return array(
            
            new TwigFilter('urlize', array($this, 'urlizeFilter')),
        );
    }

    /**
     * a custom filter called urlize which replaces URLs in plan text
     * with clickable links
     *
     * @param $string
     * @return mixed
     */
    public function urlizeFilter($string){
        $content_array = explode(" ", $string);
        $output = '';

        foreach($content_array as $content)
        {
            //starts with http://
            if(substr($content, 0, 7) == "http://")
                $content = '<a target="_blank" href="' . $content . '">' . $content . '</a>';
            
            //starts with https://
            if(substr($content, 0, 8) == "https://")
                $content = '<a target="_blank" href="' . $content . '">' . $content . '</a>';

            //starts with www.
            if(substr($content, 0, 4) == "www.")
                $content = '<a target="_blank" href="http://' . $content . '">' . $content . '</a>';

            $output .= " " . $content;
        }

            $output = trim($output);
        return $output;
    }
}

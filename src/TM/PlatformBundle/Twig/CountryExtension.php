<?php
namespace TM\PlatformBundle\Twig;

use Symfony\Component\Intl\Intl;

class CountryExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('country', array(
                $this,
                'countryFilter'
            )),
        );
    }

    public function countryFilter($countryCode, $locale = "fr")
    {
        return Intl::getRegionBundle()->getCountryName($countryCode, $locale);
    }

    public function getName()
    {
        return 'country_extension';
    }
}

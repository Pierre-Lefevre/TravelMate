<?php
namespace TM\PlatformBundle\Twig;

use Symfony\Component\Intl\Intl;

/**
 * Class CountryExtension
 * @package TM\PlatformBundle\Twig
 */
class CountryExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('country', array(
                $this,
                'countryFilter'
            )),
        );
    }

    /**
     * @param $countryCode
     * @param string $locale
     * @return null|string
     */
    public function countryFilter($countryCode, $locale = "fr")
    {
        return Intl::getRegionBundle()->getCountryName($countryCode, $locale);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'country_extension';
    }
}

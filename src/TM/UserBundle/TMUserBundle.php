<?php

namespace TM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class TMUserBundle
 * @package TM\UserBundle
 */
class TMUserBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

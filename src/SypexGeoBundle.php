<?php

declare(strict_types=1);

namespace FaritSlv\Bundle\SypexGeoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use FaritSlv\Bundle\SypexGeoBundle\DependencyInjection\SypexGeoExtension;

class SypexGeoBundle extends Bundle
{
    public function getContainerExtension(): Extension
    {
        return new SypexGeoExtension();
    }
}

<?php

namespace Johnkhansrc\IaphubBundle;

use Johnkhansrc\IaphubBundle\DependencyInjection\IaphubExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IaphubBundle extends Bundle
{
    /**
     * Resolve Extension because alias renaming.
     */
    public function getContainerExtension(): ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new IaphubExtension();
        }

        return $this->extension;
    }

}
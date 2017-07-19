<?php

namespace Dhii\Modular\Locator;

/**
 * Functionality that allows setting and retrieval of a module locator (protected).
 *
 * @since [*next-version*]
 */
trait ModuleLocatorAwareTrait
{
    /**
     * Assigns the module locator.
     *
     * @since [*next-version*]
     *
     * @param ModuleLocatorInterface $locator The locator.
     *
     * @return $this
     */
    protected function _setModuleLocator(ModuleLocatorInterface $locator)
    {
        $this->moduleLocator = $locator;

        return $this;
    }

    /**
     * Retrieves the module locator.
     *
     * @since [*next-version*]
     *
     * @return ModuleLocatorInterface|null The locator, if any.
     */
    protected function _getModuleLocator()
    {
        return $this->moduleLocator;
    }
}

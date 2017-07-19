<?php

namespace Dhii\Modular\Locator;

/**
 * Common functionality for module locators.
 *
 * @since [*next-version*]
 */
abstract class AbstractModuleLocator
{
    /**
     * Parameter-less constructor.
     * 
     * Invoke this in the real constructor.
     * 
     * @since [*next-version*]
     */
    protected function _construct()
    {
    }

    /**
     * Reads a config source into a standard config.
     * 
     * @since [*next-version*]
     * 
     * @return array The standard config.
     */
    abstract protected function _read($config);

    /**
     * Retrieves configuration sources.
     *
     * @since [*next-version*]
     *
     * @return array Configuration sources.
     */
    abstract protected function _getSources();

    /**
     * Locates module configurations.
     *
     * @since [*next-version*]
     *
     * @return mixed[] A list of module configurations.
     */
    protected function _locate()
    {
        $configs = [];
        foreach ($this->_getSources() as $_source) {
            $configs[md5($_source)] = $this->_read($_source);
        }

        return $configs;
    }

    /**
     * Determines a config key based on its source.
     *
     * @since [*next-version*]
     *
     * @param mixed $configSource The config source.
     *
     * @return string The key that identifies the source.
     */
    abstract protected function _generateKeyFromSource($configSource);
}

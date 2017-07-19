<?php

namespace Dhii\Modular\Locator;

/**
 * Functionality that allows setting and retrieval of a module configuration source (protected).
 *
 * @since [*next-version*]
 */
trait ConfigSourceAwareTrait
{
    /**
     * A config source representation.
     *
     * @since [*next-version*]
     *
     * @var mixed
     */
    protected $configSource;

    /**
     * Assigns the module config source.
     *
     * @since [*next-version*]
     *
     * @param mixed $source The source.
     *
     * @return $this
     */
    protected function _setConfigSource($source)
    {
        $this->configSource = $source;

        return $this;
    }

    /**
     * Retrieves the config source.
     *
     * @since [*next-version*]
     *
     * @return mixed The source.
     */
    protected function _getConfigSource()
    {
        return $this->configSource;
    }
}

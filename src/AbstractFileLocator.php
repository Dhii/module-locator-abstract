<?php

namespace Dhii\Modular\Locator;

use Traversable;
use InvalidArgumentException;

/**
 * Common functionality for module locators that get configuration from files.
 *
 * @since [*next-version*]
 */
abstract class AbstractFileLocator extends AbstractModuleLocator
{
    /**
     * The list of config source filenames.
     *
     * @since [*next-version*]
     *
     * @var string[]
     */
    protected $sources = array();

    /**
     * Assigns the list of source file names.
     *
     * @since [*next-version*]
     *
     * @param Traversable $sources The list of source file names.
     *
     * @throws InvalidArgumentException If sources list is not traversable.
     *
     * @return $this
     */
    protected function _setSources($sources)
    {
        if (!is_array($sources) && !($sources instanceof Traversable)) {
            throw new InvalidArgumentException('Sources list must be something traversable');
        }

        $this->sources = $sources;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since [*next-version*]
     */
    protected function _getSources()
    {
        return $this->sources;
    }
}

<?php

namespace Dhii\Modular\Locator;

/**
 * Common functionality for "could not read source" exceptions.
 *
 * @since [*next-version*]
 */
abstract class AbstractCouldNotReadSourceException extends AbstractModuleLocatorException
{
    use ConfigSourceAwareTrait;
}

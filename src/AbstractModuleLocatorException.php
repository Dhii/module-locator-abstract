<?php

namespace Dhii\Modular\Locator;

use Exception;

/**
 * Common functionality for module locator exceptions.
 *
 * @since [*next-version*]
 */
abstract class AbstractModuleLocatorException extends Exception
{
    use ModuleLocatorAwareTrait;
}

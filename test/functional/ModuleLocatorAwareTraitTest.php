<?php

namespace Dhii\Modular\Locator\FuncTest;

use Xpmock\TestCase;
use Dhii\Modular\Locator\ModuleLocatorInterface;

/**
 * Tests {@see \Dhii\Modular\Locator\ModuleLocatorAwareTrait}.
 */
class ModuleLocatorAwareTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Modular\\Locator\\ModuleLocatorAwareTrait';

    /**
     * The name of the root folder in the mock filesystem.
     *
     * @since [*next-version*]
     */
    const FS_ROOT = 'root';

    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return mixed Something that uses the trait.
     */
    public function createInstance()
    {
        $mock = $this->getMockForTrait(static::TEST_SUBJECT_CLASSNAME);

        return $mock;
    }

    /**
     * Creates a new module locator.
     *
     * @since [*next-version*]
     *
     * @return ModuleLocatorInterface The new locator.
     */
    public function createModuleLocator()
    {
        $mock = $this->mock('Dhii\\Modular\\Locator\\ModuleLocatorInterface')
                ->locate()
                ->new();

        return $mock;
    }

    /**
     * Tests whether a correct instance of the test subject can be created.
     *
     * @since [*next-version*]
     */
    public function testCanBeCreated()
    {
        $subject = $this->createInstance();

        $this->assertInternalType('object', $subject, 'Could not create an correct instance of the test subject');
    }

    /**
     * Tests whether the trait is able to set and retrieve the locator consistently.
     *
     * @since [*next-version*]
     */
    public function testCanGetSetLocator()
    {
        $subject = $this->createInstance();
        $locator = $this->createModuleLocator();
        $reflection = $this->reflect($subject);

        $reflection->_setModuleLocator($locator);
        $result = $reflection->_getModuleLocator();

        $this->assertSame($locator, $result, 'The value retrieved is not the same as the value set');
    }
}

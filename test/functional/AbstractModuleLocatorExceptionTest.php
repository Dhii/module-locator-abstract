<?php

namespace Dhii\Modular\Locator\FuncTest;

use Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Modular\Locator\AbstractModuleLocatorException}.
 */
class AbstractModuleLocatorExceptionTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Modular\\Locator\\AbstractModuleLocatorException';


    /**
     * Creates a new instance of the test subject.
     *
     * @since [*next-version*]
     *
     * @return \Dhii\Modular\Locator\AbstractModuleLocatorException
     */
    public function createInstance()
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
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

        $this->assertInstanceOf(static::TEST_SUBJECT_CLASSNAME, $subject, 'Could not create an correct instance of the test subject');
        $this->assertInstanceOf('Exception', $subject, 'Subject does not have required ancestor');
    }
}

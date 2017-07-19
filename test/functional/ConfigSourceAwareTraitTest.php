<?php

namespace Dhii\Modular\Locator\FuncTest;

use Xpmock\TestCase;

/**
 * Tests {@see \Dhii\Modular\Locator\ConfigSourceAwareTrait}.
 */
class ConfigSourceAwareTraitTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Modular\\Locator\\ConfigSourceAwareTrait';

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
     * Tests whether the trait is able to set and retrieve the source consistently.
     *
     * @since [*next-version*]
     */
    public function testCanGetSetSource()
    {
        $subject = $this->createInstance();
        $source = uniqid('config-source-');
        $reflection = $this->reflect($subject);

        $reflection->_setConfigSource($source);
        $result = $reflection->_getConfigSource();

        $this->assertSame($source, $result, 'The value retrieved is not the same as the value set');
    }
}

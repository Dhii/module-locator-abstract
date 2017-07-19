<?php

namespace Dhii\Modular\Locator\FuncTest;

use Xpmock\TestCase;
use PHPUnit_Framework_AssertionFailedError as AssertionFailedError;

/**
 * Tests {@see \Dhii\Modular\Locator\AbstractModuleLocator}.
 */
class AbstractModuleLocatorTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Modular\\Locator\\AbstractModuleLocator';

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
     * @return \Dhii\Modular\Locator\AbstractModuleLocator
     */
    public function createInstance($sources = array())
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
                ->_read(function ($source) {
                    return $source;
                })
                ->_getSources(function () use ($sources) {
                    return $sources;
                })
                ->_generateKeyFromSource(function ($source) {
                    return md5($source);
                })
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
    }

    /**
     * Tests whether the main location functionality works correctly.
     *
     * @since [*next-version*]
     */
    public function testCanLocate()
    {
        $sourcePrefix = 'source-';
        $sources = array(
            uniqid($sourcePrefix),
            uniqid($sourcePrefix),
            uniqid($sourcePrefix),
        );
        $subject = $this->createInstance($sources);
        $_subject = $this->reflect($subject);

        $result = $_subject->_locate();

        $this->assertEquals(array_values($sources), array_values($result), 'The expected modules were not located', 0.0, 10, true);
    }

    /**
     * Fails if haystack does not contain a string that matches the given expression.
     *
     * @since [*next-version*]
     *
     * @param string   $expr     The regular expression.
     * @param string[] $haystack The strings to match.
     * @param string   $message  The failure message.
     *
     * @throws AssertionFailedError On failure.
     */
    protected function assertContainsRegex($expr, $haystack, $message = null)
    {
        foreach ($haystack as $_item) {
            if (preg_match($expr, $_item)) {
                return true;
            }
        }

        throw new AssertionFailedError($message);
    }
}

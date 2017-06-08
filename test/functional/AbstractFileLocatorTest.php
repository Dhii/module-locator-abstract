<?php

namespace Dhii\Modular\Locator\FuncTest;

use Xpmock\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit_Framework_AssertionFailedError as AssertionFailedError;

/**
 * Tests {@see \Dhii\Modular\Locator\AbstractFileLocator}.
 */
class AbstractFileLocatorTest extends TestCase
{
    /**
     * The name of the test subject.
     *
     * @since [*next-version*]
     */
    const TEST_SUBJECT_CLASSNAME = 'Dhii\\Modular\\Locator\\AbstractFileLocator';

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
     * @return \Dhii\Modular\Locator\AbstractFileLocator
     */
    public function createInstance($sources = array())
    {
        $mock = $this->mock(static::TEST_SUBJECT_CLASSNAME)
            ->_read(function ($source) {
                return file_get_contents($source);
            })
            ->new();

        $reflection = $this->reflect($mock);
        $reflection->_setSources($sources);

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
        $fs = $this->_createFilesystem();
        $basePath = $fs->url();
        $sources = array();
        $structure = $this->_getFilesystemStructure();
        foreach (array_keys($structure) as $_filename) {
            $filename = sprintf('%1$s/%2$s', $basePath, $_filename);
            $sources[$filename] = $filename;
        }
        $subject = $this->createInstance($sources);
        $reflection = $this->reflect($subject);

        $configs = $reflection->_locate();
        $this->assertCount(count($sources), $configs, 'Wrong amount of configs located');
        foreach (array_keys($structure) as $_path) {
            $expr = sprintf('/%1$s/', preg_quote($_path).'.*', '/');
            $this->assertContainsRegex($expr, $configs, sprintf('Located configs do not contain "%1$s"', $_path));
        }
    }

    /**
     * Creates a virtual filesystem.
     * 
     * @since [*next-version*]
     * 
     * @return vfsStreamDirectory The filesystem.
     */
    protected function _createFilesystem()
    {
        $fs = vfsStream::setup(static::FS_ROOT);

        vfsStream::create($this->_getFilesystemStructure(), $fs);

        return $fs;
    }

    /**
     * Defines the mock filesystem structure.
     *
     * @since [*next-version*]
     *
     * @return array The structure.
     */
    protected function _getFilesystemStructure()
    {
        return array(
            'config-1' => uniqid('config-1-'),
            'config-2' => uniqid('config-2-'),
            'config-3' => uniqid('config-3-'),
        );
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

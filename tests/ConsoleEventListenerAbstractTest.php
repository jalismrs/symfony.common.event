<?php
declare(strict_types = 1);

namespace Tests;

use Jalismrs\Symfony\Common\ConsoleEventListenerAbstract;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnexpectedValueException;

/**
 * Class ConsoleEventListenerAbstractTest
 *
 * @package Tests
 *
 * @covers  \Jalismrs\Symfony\Common\ConsoleEventListenerAbstract
 */
final class ConsoleEventListenerAbstractTest extends
    TestCase
{
    /**
     * testGetStyle
     *
     * @return void
     */
    public function testGetStyle() : void
    {
        // arrange
        $systemUnderTest = $this->createSUT();
        
        $style = $this->createMock(SymfonyStyle::class);
        
        $systemUnderTest->setStyle($style);
        
        // act
        $output = $systemUnderTest->getStyle();
        
        // assert
        self::assertSame(
            $style,
            $output,
        );
    }
    
    /**
     * createSUT
     *
     * @return \Jalismrs\Symfony\Common\ConsoleEventListenerAbstract
     */
    private function createSUT() : ConsoleEventListenerAbstract
    {
        return new class() extends
            ConsoleEventListenerAbstract {
        };
    }
    
    /**
     * testGetStyleThrowsUnexpectedValueException
     *
     * @return void
     */
    public function testGetStyleThrowsUnexpectedValueException() : void
    {
        // arrange
        $systemUnderTest = $this->createSUT();
        
        // assert
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('style has not been set');
        
        // act
        $systemUnderTest->getStyle();
    }
}

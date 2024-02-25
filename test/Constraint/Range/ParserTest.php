<?php
namespace CeusMedia\SemVerTest\Constraint\Range;

use CeusMedia\SemVer\Constraint\Range;
use CeusMedia\SemVer\Constraint\Range\Parser;
use CeusMedia\SemVer\Version;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Constraint\Range\Parser
 */
class ParserTest extends TestCase
{
	/**
	 *	@covers		::parse
	 */
	public function testParse(): void
	{
		$expected	= Range::create()->setAtLeast( new Version( '2' ) );
		$actual		= Parser::parse( '>=2');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()->setGreaterThan( new Version( '2' ) );
		$actual		= Parser::parse( '>2');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()->setAtMost( new Version( '2' ) );
		$actual		= Parser::parse( '<=2');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()->setLowerThan( new Version( '2' ) );
		$actual		= Parser::parse( '<2');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()
			->setAtLeast( new Version( '2' ) )
			->setLowerThan( new Version( '3' ) );
		$actual		= Parser::parse( '^2');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()
			->setAtLeast( new Version( '2.3' ) )
			->setLowerThan( new Version( '2.4' ) );
		$actual		= Parser::parse( '^2.3');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()
			->setAtLeast( new Version( '2.3.4' ) )
			->setLowerThan( new Version( '2.3.5' ) );
		$actual		= Parser::parse( '^2.3.4');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()
			->setAtLeast( new Version( '2' ) )
			->setAtMost( new Version( '3' ) );
		$actual		= Parser::parse( '2-3');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()
			->setAtLeast( new Version( '2.3.4' ) )
			->setAtMost( new Version( '3.4.5' ) );
		$actual		= Parser::parse( '2.3.4-3.4.5');
		self::assertEquals( $expected, $actual );

		$expected	= Range::create()
			->setAtLeast( new Version( '2.3.4' ) )
			->setAtMost( new Version( '2.3.4' ) );
		$actual		= Parser::parse( '2.3.4');
		self::assertEquals( $expected, $actual );
	}
}

<?php
namespace CeusMedia\SemVerTest\Constraint;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Constraint\Range;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Constraint\Range
 */
class RangeTest extends TestCase
{
	/**
	*	@covers		::__construct
	*	@covers		::checkVersion
	 */
	public function testConstruct(): void
	{
		$r	= new Range( '>=2' );
		self::assertFalse( $r->checkVersion( new Version( '1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.0' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.0.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '>2' );
		self::assertFalse( $r->checkVersion( new Version( '1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.0' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.0.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '>=2.2' );
		self::assertFalse( $r->checkVersion( new Version( '1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.2.0' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.3' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '>2.2' );
		self::assertFalse( $r->checkVersion( new Version( '1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.2.0' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.3' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '<=2' );
		self::assertTrue( $r->checkVersion( new Version( '1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.0' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.0.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '<2' );
		self::assertTrue( $r->checkVersion( new Version( '1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.0' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.0.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '<=2.2' );
		self::assertTrue( $r->checkVersion( new Version( '1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.2.0' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.2.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '<2.2' );
		self::assertTrue( $r->checkVersion( new Version( '1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.2.0' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.2.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '>=3.2.1' );
		self::assertFalse( $r->checkVersion( new Version( '3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3.2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3.2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3.2.2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3.3' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '4' ) ) );

		$r	= new Range( '>3.2.1' );
		self::assertFalse( $r->checkVersion( new Version( '3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3.2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '3.2.1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3.2.2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '3.3' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '4' ) ) );

		$r	= new Range( '^1' );
		self::assertFalse( $r->checkVersion( new Version( '0.9' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '1' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '1.0' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.3' ) ) );

		$r	= new Range( '^1.2' );
		self::assertFalse( $r->checkVersion( new Version( '0.9' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '1.0' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '1.2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '1.2.0' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '1.2.1' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '1.3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2.3' ) ) );

		$r	= new Range( '1.2.3' );
		self::assertFalse( $r->checkVersion( new Version( '0.9' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '1.2' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '1.2.2' ) ) );
		self::assertTrue( $r->checkVersion( new Version( '1.2.3' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '1.2.4' ) ) );
		self::assertFalse( $r->checkVersion( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::parseConstraint
	 */
	public function testParseConstraint(): void
	{
		$expected	= ( new Range() )
			->setAtLeast( new Version( '2' ) );
		$actual	= Range::parseConstraint( '>=2');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setGreaterThan( new Version( '2' ) );
		$actual	= Range::parseConstraint( '>2');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtMost( new Version( '2' ) );
		$actual	= Range::parseConstraint( '<=2');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setLowerThan( new Version( '2' ) );
		$actual	= Range::parseConstraint( '<2');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2' ) )
			->setLowerThan( new Version( '3' ) );
		$actual	= Range::parseConstraint( '^2');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3' ) )
			->setLowerThan( new Version( '2.4' ) );
		$actual	= Range::parseConstraint( '^2.3');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3.4' ) )
			->setLowerThan( new Version( '2.3.5' ) );
		$actual	= Range::parseConstraint( '^2.3.4');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2' ) )
			->setAtMost( new Version( '3' ) );
		$actual	= Range::parseConstraint( '2-3');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3.4' ) )
			->setAtMost( new Version( '3.4.5' ) );
		$actual	= Range::parseConstraint( '2.3.4-3.4.5');
		self::assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3.4' ) )
			->setAtMost( new Version( '2.3.4' ) );
		$actual	= Range::parseConstraint( '2.3.4');
		self::assertEquals( $expected, $actual );
	}

	/**
	 *	@covers		::getAtLeast
	 *	@covers		::setAtLeast
	 */
	public function testGetAndSetAtLeast(): void
	{
		$range	= new Range();
		$range->setAtLeast( new Version( '1' ) );
		self::assertEquals( new Version( '1' ), $range->getAtLeast() );

		$range->setAtLeast( new Version( '2.3.4' ) );
		self::assertEquals( new Version( '2.3.4' ), $range->getAtLeast() );
	}

	/**
	 *	@covers		::getAtMost
	 *	@covers		::setAtMost
	 */
	public function testGetAndSetAtMost(): void
	{
		$range	= new Range();
		$range->setAtMost( new Version( '1' ) );
		self::assertEquals( new Version( '1' ), $range->getAtMost() );

		$range->setAtMost( new Version( '2.3.4' ) );
		self::assertEquals( new Version( '2.3.4' ), $range->getAtMost() );
	}

	/**
	 *	@covers		::getGreaterThan
	 *	@covers		::setGreaterThan
	 */
	public function testGetAndSetGreaterThan(): void
	{
		$range	= new Range();
		$range->setGreaterThan( new Version( '1' ) );
		self::assertEquals( new Version( '1' ), $range->getGreaterThan() );

		$range->setGreaterThan( new Version( '2.3.4' ) );
		self::assertEquals( new Version( '2.3.4' ), $range->getGreaterThan() );
	}

	/**
	 *	@covers		::getLowerThan
	 *	@covers		::setLowerThan
	 */
	public function testGetAndSetLowerThan(): void
	{
		$range	= new Range();
		$range->setLowerThan( new Version( '1' ) );
		self::assertEquals( new Version( '1' ), $range->getLowerThan() );

		$range->setLowerThan( new Version( '2.3.4' ) );
		self::assertEquals( new Version( '2.3.4' ), $range->getLowerThan() );
	}
}

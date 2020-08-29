<?php
use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Expression;
use CeusMedia\SemVer\Expression\Range;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		CeusMedia\SemVer\Expression\Range
 */
class RangeTest extends TestCase
{
	/**
	*	@covers		::__construct
	*	@covers		::checkVersion
	 */
	public function testConstruct()
	{
		$r	= new Range( '>=2' );
		$this->assertFalse( $r->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.0' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.0.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '>2' );
		$this->assertFalse( $r->checkVersion( new Version( '1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.0' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.0.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '>=2.2' );
		$this->assertFalse( $r->checkVersion( new Version( '1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.2.0' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.3' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '>2.2' );
		$this->assertFalse( $r->checkVersion( new Version( '1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.2.0' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.3' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '<=2' );
		$this->assertTrue( $r->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.0' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.0.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '<2' );
		$this->assertTrue( $r->checkVersion( new Version( '1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.0' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.0.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3' ) ) );

		$r	= new Range( '<=2.2' );
		$this->assertTrue( $r->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.2.0' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.2.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '<2.2' );
		$this->assertTrue( $r->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '2.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.2.0' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.2.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3.2' ) ) );

		$r	= new Range( '>=3.2.1' );
		$this->assertFalse( $r->checkVersion( new Version( '3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3.2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3.2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3.2.2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3.3' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '4' ) ) );

		$r	= new Range( '>3.2.1' );
		$this->assertFalse( $r->checkVersion( new Version( '3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3.2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '3.2.1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3.2.2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '3.3' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '4' ) ) );

		$r	= new Range( '^1' );
		$this->assertFalse( $r->checkVersion( new Version( '0.9' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '1.0' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.3' ) ) );

		$r	= new Range( '^1.2' );
		$this->assertFalse( $r->checkVersion( new Version( '0.9' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '1.0' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '1.2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '1.2.0' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '1.2.1' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '1.3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2.3' ) ) );

		$r	= new Range( '1.2.3' );
		$this->assertFalse( $r->checkVersion( new Version( '0.9' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '1.2' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '1.2.2' ) ) );
		$this->assertTrue( $r->checkVersion( new Version( '1.2.3' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '1.2.4' ) ) );
		$this->assertFalse( $r->checkVersion( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::parseExpression
	 */
	public function testParseExpression()
	{
		$expected	= ( new Range() )
			->setAtLeast( new Version( '2' ) );
		$actual	= Range::parseExpression( '>=2');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setGreaterThan( new Version( '2' ) );
		$actual	= Range::parseExpression( '>2');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtMost( new Version( '2' ) );
		$actual	= Range::parseExpression( '<=2');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setLowerThan( new Version( '2' ) );
		$actual	= Range::parseExpression( '<2');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2' ) )
			->setLowerThan( new Version( '3' ) );
		$actual	= Range::parseExpression( '^2');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3' ) )
			->setLowerThan( new Version( '2.4' ) );
		$actual	= Range::parseExpression( '^2.3');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3.4' ) )
			->setLowerThan( new Version( '2.3.5' ) );
		$actual	= Range::parseExpression( '^2.3.4');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2' ) )
			->setAtMost( new Version( '3' ) );
		$actual	= Range::parseExpression( '2-3');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3.4' ) )
			->setAtMost( new Version( '3.4.5' ) );
		$actual	= Range::parseExpression( '2.3.4-3.4.5');
		$this->assertEquals( $expected, $actual );

		$expected	= ( new Range() )
			->setAtLeast( new Version( '2.3.4' ) )
			->setAtMost( new Version( '2.3.4' ) );
		$actual	= Range::parseExpression( '2.3.4');
		$this->assertEquals( $expected, $actual );
	}

	/**
	 *	@covers		::getAtLeast
	 *	@covers		::setAtLeast
	 */
	public function testGetAndSetAtLeast()
	{
		$range	= new Range();
		$range->setAtLeast( new Version( '1' ) );
		$this->assertEquals( new Version( '1' ), $range->getAtLeast() );

		$range->setAtLeast( new Version( '2.3.4' ) );
		$this->assertEquals( new Version( '2.3.4' ), $range->getAtLeast() );
	}

	/**
	 *	@covers		::getAtMost
	 *	@covers		::setAtMost
	 */
	public function testGetAndSetAtMost()
	{
		$range	= new Range();
		$range->setAtMost( new Version( '1' ) );
		$this->assertEquals( new Version( '1' ), $range->getAtMost() );

		$range->setAtMost( new Version( '2.3.4' ) );
		$this->assertEquals( new Version( '2.3.4' ), $range->getAtMost() );
	}

	/**
	 *	@covers		::getGreaterThan
	 *	@covers		::setGreaterThan
	 */
	public function testGetAndSetGreaterThan()
	{
		$range	= new Range();
		$range->setGreaterThan( new Version( '1' ) );
		$this->assertEquals( new Version( '1' ), $range->getGreaterThan() );

		$range->setGreaterThan( new Version( '2.3.4' ) );
		$this->assertEquals( new Version( '2.3.4' ), $range->getGreaterThan() );
	}

	/**
	 *	@covers		::getLowerThan
	 *	@covers		::setLowerThan
	 */
	public function testGetAndSetLowerThan()
	{
		$range	= new Range();
		$range->setLowerThan( new Version( '1' ) );
		$this->assertEquals( new Version( '1' ), $range->getLowerThan() );

		$range->setLowerThan( new Version( '2.3.4' ) );
		$this->assertEquals( new Version( '2.3.4' ), $range->getLowerThan() );
	}
}

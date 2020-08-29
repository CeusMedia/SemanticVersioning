<?php
use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Version\Comparator;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		CeusMedia\SemVer\Version\Comparator
 */
class ComparatorTest extends TestCase
{
	/**
	 *	@covers		::differs
	 */
	public function testDiffers()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertTrue( Comparator::differs( $version, new Version( '0.9' ) ) );
		$this->assertTrue( Comparator::differs( $version, new Version( '1' ) ) );
		$this->assertTrue( Comparator::differs( $version, new Version( '1.2.2' ) ) );
		$this->assertFalse( Comparator::differs( $version, new Version( '1.2.3' ) ) );
		$this->assertTrue( Comparator::differs( $version, new Version( '1.2.4' ) ) );
		$this->assertTrue( Comparator::differs( $version, new Version( '1.3' ) ) );
		$this->assertTrue( Comparator::differs( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::equals
	 */
	public function testEquals()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertFalse( Comparator::equals( $version, new Version( '0.9' ) ) );
		$this->assertFalse( Comparator::equals( $version, new Version( '1' ) ) );
		$this->assertFalse( Comparator::equals( $version, new Version( '1.2.2' ) ) );
		$this->assertTrue( Comparator::equals( $version, new Version( '1.2.3' ) ) );
		$this->assertFalse( Comparator::equals( $version, new Version( '1.2.4' ) ) );
		$this->assertFalse( Comparator::equals( $version, new Version( '1.3' ) ) );
		$this->assertFalse( Comparator::equals( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isAtMost
	 */
	public function testIsAtMost()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertFalse( Comparator::isAtMost( $version, new Version( '0.9' ) ) );
		$this->assertFalse( Comparator::isAtMost( $version, new Version( '1' ) ) );
		$this->assertFalse( Comparator::isAtMost( $version, new Version( '1.2.2' ) ) );
		$this->assertTrue( Comparator::isAtMost( $version, new Version( '1.2.3' ) ) );
		$this->assertTrue( Comparator::isAtMost( $version, new Version( '1.2.4' ) ) );
		$this->assertTrue( Comparator::isAtMost( $version, new Version( '1.3' ) ) );
		$this->assertTrue( Comparator::isAtMost( $version, new Version( '2' ) ) );
	}
	/**
	 *	@covers		::isAtLeast
	 */
	public function testIsAtLeast()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertTrue( Comparator::isAtLeast( $version, new Version( '0.9' ) ) );
		$this->assertTrue( Comparator::isAtLeast( $version, new Version( '1' ) ) );
		$this->assertTrue( Comparator::isAtLeast( $version, new Version( '1.2.2' ) ) );
		$this->assertTrue( Comparator::isAtLeast( $version, new Version( '1.2.3' ) ) );
		$this->assertFalse( Comparator::isAtLeast( $version, new Version( '1.2.4' ) ) );
		$this->assertFalse( Comparator::isAtLeast( $version, new Version( '1.3' ) ) );
		$this->assertFalse( Comparator::isAtLeast( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isGreater
	 */
	public function testIsGreater()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertTrue( Comparator::isGreater( $version, new Version( '0.9' ) ) );
		$this->assertTrue( Comparator::isGreater( $version, new Version( '1' ) ) );
		$this->assertTrue( Comparator::isGreater( $version, new Version( '1.2.2' ) ) );
		$this->assertFalse( Comparator::isGreater( $version, new Version( '1.2.3' ) ) );
		$this->assertFalse( Comparator::isGreater( $version, new Version( '1.2.4' ) ) );
		$this->assertFalse( Comparator::isGreater( $version, new Version( '1.3' ) ) );
		$this->assertFalse( Comparator::isGreater( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isLower
	 */
	public function testIsLower()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertFalse( Comparator::isLower( $version, new Version( '0.9' ) ) );
		$this->assertFalse( Comparator::isLower( $version, new Version( '1' ) ) );
		$this->assertFalse( Comparator::isLower( $version, new Version( '1.2.2' ) ) );
		$this->assertFalse( Comparator::isLower( $version, new Version( '1.2.3' ) ) );
		$this->assertTrue( Comparator::isLower( $version, new Version( '1.2.4' ) ) );
		$this->assertTrue( Comparator::isLower( $version, new Version( '1.3' ) ) );
		$this->assertTrue( Comparator::isLower( $version, new Version( '2' ) ) );
	}
}

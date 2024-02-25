<?php
namespace CeusMedia\SemVerTest\Version;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Version\Comparator;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Version\Comparator
 */
class ComparatorTest extends TestCase
{
	/**
	 *	@covers		::differs
	 */
	public function testDiffers(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertTrue( Comparator::differs( $version, new Version( '0.9' ) ) );
		self::assertTrue( Comparator::differs( $version, new Version( '1' ) ) );
		self::assertTrue( Comparator::differs( $version, new Version( '1.2.2' ) ) );
		self::assertFalse( Comparator::differs( $version, new Version( '1.2.3' ) ) );
		self::assertTrue( Comparator::differs( $version, new Version( '1.2.4' ) ) );
		self::assertTrue( Comparator::differs( $version, new Version( '1.3' ) ) );
		self::assertTrue( Comparator::differs( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::equals
	 */
	public function testEquals(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertFalse( Comparator::equals( $version, new Version( '0.9' ) ) );
		self::assertFalse( Comparator::equals( $version, new Version( '1' ) ) );
		self::assertFalse( Comparator::equals( $version, new Version( '1.2.2' ) ) );
		self::assertTrue( Comparator::equals( $version, new Version( '1.2.3' ) ) );
		self::assertFalse( Comparator::equals( $version, new Version( '1.2.4' ) ) );
		self::assertFalse( Comparator::equals( $version, new Version( '1.3' ) ) );
		self::assertFalse( Comparator::equals( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isAtMost
	 */
	public function testIsAtMost(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertFalse( Comparator::isAtMost( $version, new Version( '0.9' ) ) );
		self::assertFalse( Comparator::isAtMost( $version, new Version( '1' ) ) );
		self::assertFalse( Comparator::isAtMost( $version, new Version( '1.2.2' ) ) );
		self::assertTrue( Comparator::isAtMost( $version, new Version( '1.2.3' ) ) );
		self::assertTrue( Comparator::isAtMost( $version, new Version( '1.2.4' ) ) );
		self::assertTrue( Comparator::isAtMost( $version, new Version( '1.3' ) ) );
		self::assertTrue( Comparator::isAtMost( $version, new Version( '2' ) ) );
	}
	/**
	 *	@covers		::isAtLeast
	 */
	public function testIsAtLeast(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertTrue( Comparator::isAtLeast( $version, new Version( '0.9' ) ) );
		self::assertTrue( Comparator::isAtLeast( $version, new Version( '1' ) ) );
		self::assertTrue( Comparator::isAtLeast( $version, new Version( '1.2.2' ) ) );
		self::assertTrue( Comparator::isAtLeast( $version, new Version( '1.2.3' ) ) );
		self::assertFalse( Comparator::isAtLeast( $version, new Version( '1.2.4' ) ) );
		self::assertFalse( Comparator::isAtLeast( $version, new Version( '1.3' ) ) );
		self::assertFalse( Comparator::isAtLeast( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isGreater
	 */
	public function testIsGreater(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertTrue( Comparator::isGreater( $version, new Version( '0.9' ) ) );
		self::assertTrue( Comparator::isGreater( $version, new Version( '1' ) ) );
		self::assertTrue( Comparator::isGreater( $version, new Version( '1.2.2' ) ) );
		self::assertFalse( Comparator::isGreater( $version, new Version( '1.2.3' ) ) );
		self::assertFalse( Comparator::isGreater( $version, new Version( '1.2.4' ) ) );
		self::assertFalse( Comparator::isGreater( $version, new Version( '1.3' ) ) );
		self::assertFalse( Comparator::isGreater( $version, new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isLower
	 */
	public function testIsLower(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertFalse( Comparator::isLower( $version, new Version( '0.9' ) ) );
		self::assertFalse( Comparator::isLower( $version, new Version( '1' ) ) );
		self::assertFalse( Comparator::isLower( $version, new Version( '1.2.2' ) ) );
		self::assertFalse( Comparator::isLower( $version, new Version( '1.2.3' ) ) );
		self::assertTrue( Comparator::isLower( $version, new Version( '1.2.4' ) ) );
		self::assertTrue( Comparator::isLower( $version, new Version( '1.3' ) ) );
		self::assertTrue( Comparator::isLower( $version, new Version( '2' ) ) );
	}
}

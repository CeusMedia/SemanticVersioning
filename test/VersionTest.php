<?php
namespace CeusMedia\SemVerTest;

use CeusMedia\SemVer\Version;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Version
 */
class VersionTest extends TestCase
{
	/**
	 *	@covers		::getMajor
	 *	@covers		::setMajor
	 *	@covers		::parse
	 */
	public function testGetAndSetMajor(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertEquals( 1, $version->getMajor() );

		$version->setMajor( 2 );
		self::assertEquals( 2, $version->getMajor() );
	}

	/**
	 *	@covers		::getMinor
	 *	@covers		::setMinor
	 *	@covers		::parse
	 */
	public function testGetAndSetMinor(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertEquals( 2, $version->getMinor() );

		$version->setMinor( 3 );
		self::assertEquals( 3, $version->getMinor() );
	}

	/**
	 *	@covers		::getPatch
	 *	@covers		::setPatch
	 *	@covers		::parse
	 */
	public function testGetAndSetPatch(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertEquals( 3, $version->getPatch() );
		self::assertEquals( '1.2.3', $version->render() );

		$version->setPatch( 4 );
		self::assertEquals( 4, $version->getPatch() );
		self::assertEquals( '1.2.4', $version->render() );
	}

	/**
	 *	@covers		::getPreRelease
	 *	@covers		::setPreRelease
	 *	@covers		::parse
	 */
	public function testGetAndSetPreRelease(): void
	{
		$version	= Version::parse( '1.2.3-4+5' );
		self::assertEquals( '4', $version->getPreRelease() );

		$version->setPreRelease( '5' );
		self::assertEquals( '5', $version->getPreRelease() );
	}

	/**
	 *	@covers		::getBuild
	 *	@covers		::setBuild
	 *	@covers		::parse
	 */
	public function testGetAndSetBuild(): void
	{
		$version	= Version::parse( '1.2.3-4+5' );
		self::assertEquals( '5', $version->getBuild() );

		$version->setBuild( 6 );
		self::assertEquals( 6, $version->getBuild() );
	}

	/**
	 *	@covers		::isAtMost
	 *	@covers		::parse
	 */
	public function testIsAtMost(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertFalse( $version->isAtMost( new Version( '0.9' ) ) );
		self::assertFalse( $version->isAtMost( new Version( '1' ) ) );
		self::assertFalse( $version->isAtMost( new Version( '1.2.2' ) ) );
		self::assertTrue( $version->isAtMost( new Version( '1.2.3' ) ) );
		self::assertTrue( $version->isAtMost( new Version( '1.2.4' ) ) );
		self::assertTrue( $version->isAtMost( new Version( '1.3' ) ) );
		self::assertTrue( $version->isAtMost( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isAtLeast
	 *	@covers		::parse
	 */
	public function testIsAtLeast(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertTrue( $version->isAtLeast( new Version( '0.9' ) ) );
		self::assertTrue( $version->isAtLeast( new Version( '1' ) ) );
		self::assertTrue( $version->isAtLeast( new Version( '1.2.2' ) ) );
		self::assertTrue( $version->isAtLeast( new Version( '1.2.3' ) ) );
		self::assertFalse( $version->isAtLeast( new Version( '1.2.4' ) ) );
		self::assertFalse( $version->isAtLeast( new Version( '1.3' ) ) );
		self::assertFalse( $version->isAtLeast( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isGreaterThan
	 *	@covers		::parse
	 */
	public function testIsGreaterThan(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertTrue( $version->isGreaterThan( new Version( '0.9' ) ) );
		self::assertTrue( $version->isGreaterThan( new Version( '1' ) ) );
		self::assertTrue( $version->isGreaterThan( new Version( '1.2.2' ) ) );
		self::assertFalse( $version->isGreaterThan( new Version( '1.2.3' ) ) );
		self::assertFalse( $version->isGreaterThan( new Version( '1.2.4' ) ) );
		self::assertFalse( $version->isGreaterThan( new Version( '1.3' ) ) );
		self::assertFalse( $version->isGreaterThan( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isLowerThan
	 *	@covers		::parse
	 */
	public function testIsLowerThan(): void
	{
		$version	= Version::parse( '1.2.3' );
		self::assertFalse( $version->isLowerThan( new Version( '0.9' ) ) );
		self::assertFalse( $version->isLowerThan( new Version( '1' ) ) );
		self::assertFalse( $version->isLowerThan( new Version( '1.2.2' ) ) );
		self::assertFalse( $version->isLowerThan( new Version( '1.2.3' ) ) );
		self::assertTrue( $version->isLowerThan( new Version( '1.2.4' ) ) );
		self::assertTrue( $version->isLowerThan( new Version( '1.3' ) ) );
		self::assertTrue( $version->isLowerThan( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::incrementMajor
	 *	@covers		::parse
	 */
	public function testIncrementMajor(): void
	{
		$version	= Version::parse( '1.2.3-4' );
		$expected	= Version::parse( '2.0.0' );
		self::assertEquals( $expected, $version->incrementMajor() );
	}

	/**
	 *	@covers		::incrementMinor
	 *	@covers		::parse
	 */
	public function testIncrementMinor(): void
	{
		$version	= Version::parse( '1.2.3-4' );
		$expected	= Version::parse( '1.3.0' );
		self::assertEquals( $expected, $version->incrementMinor() );
	}

	/**
	 *	@covers		::incrementPatch
	 *	@covers		::parse
	 */
	public function testIncrementPatch(): void
	{
		$version	= Version::parse( '1.2.3-4' );
		$expected	= Version::parse( '1.2.4' );
		self::assertEquals( $expected, $version->incrementPatch() );
	}

	/**
	 *	@covers		::isPublic
	 *	@covers		::parse
	 */
	public function testIsPublic(): void
	{
		$version	= Version::parse( '0.9.9' );
		self::assertFalse( $version->isPublic() );

		$version	= Version::parse( '1.0.0' );
		self::assertTrue( $version->isPublic() );

		$version	= Version::parse( '2' );
		self::assertTrue( $version->isPublic() );
	}
}

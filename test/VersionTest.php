<?php
use CeusMedia\SemVer\Version;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		CeusMedia\SemVer\Version
 */
class VersionTest extends TestCase
{
	/**
	 *	@covers		::getMajor
	 *	@covers		::setMajor
	 *	@covers		::parse
	 */
	public function testGetAndSetMajor()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertEquals( '1', $version->getMajor() );

		$version->setMajor( '2' );
		$this->assertEquals( '2', $version->getMajor() );
	}

	/**
	 *	@covers		::getMinor
	 *	@covers		::setMinor
	 *	@covers		::parse
	 */
	public function testGetAndSetMinor()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertEquals( '2', $version->getMinor() );

		$version->setMinor( '3' );
		$this->assertEquals( '3', $version->getMinor() );
	}

	/**
	 *	@covers		::getPatch
	 *	@covers		::setPatch
	 *	@covers		::parse
	 */
	public function testGetAndSetPatch()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertEquals( '3', $version->getPatch() );
		$this->assertEquals( '1.2.3', $version->render() );

		$version->setPatch( '4' );
		$this->assertEquals( '4', $version->getPatch() );
		$this->assertEquals( '1.2.4', $version->render() );
	}

	/**
	 *	@covers		::getPreRelease
	 *	@covers		::setPreRelease
	 *	@covers		::parse
	 */
	public function testGetAndSetPreRelease()
	{
		$version	= Version::parse( '1.2.3-4+5' );
		$this->assertEquals( '4', $version->getPreRelease() );

		$version->setPreRelease( '5' );
		$this->assertEquals( '5', $version->getPreRelease() );
	}

	/**
	 *	@covers		::getBuild
	 *	@covers		::setBuild
	 *	@covers		::parse
	 */
	public function testGetAndSetBuild()
	{
		$version	= Version::parse( '1.2.3-4+5' );
		$this->assertEquals( '5', $version->getBuild() );

		$version->setBuild( '6' );
		$this->assertEquals( '6', $version->getBuild() );
	}

	/**
	 *	@covers		::isAtMost
	 *	@covers		::parse
	 */
	public function testIsAtMost()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertFalse( $version->isAtMost( new Version( '0.9' ) ) );
		$this->assertFalse( $version->isAtMost( new Version( '1' ) ) );
		$this->assertFalse( $version->isAtMost( new Version( '1.2.2' ) ) );
		$this->assertTrue( $version->isAtMost( new Version( '1.2.3' ) ) );
		$this->assertTrue( $version->isAtMost( new Version( '1.2.4' ) ) );
		$this->assertTrue( $version->isAtMost( new Version( '1.3' ) ) );
		$this->assertTrue( $version->isAtMost( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isAtLeast
	 *	@covers		::parse
	 */
	public function testIsAtLeast()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertTrue( $version->isAtLeast( new Version( '0.9' ) ) );
		$this->assertTrue( $version->isAtLeast( new Version( '1' ) ) );
		$this->assertTrue( $version->isAtLeast( new Version( '1.2.2' ) ) );
		$this->assertTrue( $version->isAtLeast( new Version( '1.2.3' ) ) );
		$this->assertFalse( $version->isAtLeast( new Version( '1.2.4' ) ) );
		$this->assertFalse( $version->isAtLeast( new Version( '1.3' ) ) );
		$this->assertFalse( $version->isAtLeast( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isGreaterThan
	 *	@covers		::parse
	 */
	public function testIsGreaterThan()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertTrue( $version->isGreaterThan( new Version( '0.9' ) ) );
		$this->assertTrue( $version->isGreaterThan( new Version( '1' ) ) );
		$this->assertTrue( $version->isGreaterThan( new Version( '1.2.2' ) ) );
		$this->assertFalse( $version->isGreaterThan( new Version( '1.2.3' ) ) );
		$this->assertFalse( $version->isGreaterThan( new Version( '1.2.4' ) ) );
		$this->assertFalse( $version->isGreaterThan( new Version( '1.3' ) ) );
		$this->assertFalse( $version->isGreaterThan( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::isLowerThan
	 *	@covers		::parse
	 */
	public function testIsLowerThan()
	{
		$version	= Version::parse( '1.2.3' );
		$this->assertFalse( $version->isLowerThan( new Version( '0.9' ) ) );
		$this->assertFalse( $version->isLowerThan( new Version( '1' ) ) );
		$this->assertFalse( $version->isLowerThan( new Version( '1.2.2' ) ) );
		$this->assertFalse( $version->isLowerThan( new Version( '1.2.3' ) ) );
		$this->assertTrue( $version->isLowerThan( new Version( '1.2.4' ) ) );
		$this->assertTrue( $version->isLowerThan( new Version( '1.3' ) ) );
		$this->assertTrue( $version->isLowerThan( new Version( '2' ) ) );
	}

	/**
	 *	@covers		::incrementMajor
	 *	@covers		::parse
	 */
	public function testIncrementMajor()
	{
		$version	= Version::parse( '1.2.3-4' );
		$expected	= Version::parse( '2.0.0' );
		$this->assertEquals( $expected, $version->incrementMajor() );
	}

	/**
	 *	@covers		::incrementMinor
	 *	@covers		::parse
	 */
	public function testIncrementMinor()
	{
		$version	= Version::parse( '1.2.3-4' );
		$expected	= Version::parse( '1.3.0' );
		$this->assertEquals( $expected, $version->incrementMinor() );
	}

	/**
	 *	@covers		::incrementPatch
	 *	@covers		::parse
	 */
	public function testIncrementPatch()
	{
		$version	= Version::parse( '1.2.3-4' );
		$expected	= Version::parse( '1.2.4' );
		$this->assertEquals( $expected, $version->incrementPatch() );
	}

	/**
	 *	@covers		::isPublic
	 *	@covers		::parse
	 */
	public function testIsPublic()
	{
		$version	= Version::parse( '0.9.9' );
		$this->assertFalse( $version->isPublic() );

		$version	= Version::parse( '1.0.0' );
		$this->assertTrue( $version->isPublic() );

		$version	= Version::parse( '2' );
		$this->assertTrue( $version->isPublic() );
	}
}

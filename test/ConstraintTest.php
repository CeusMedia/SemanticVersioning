<?php
namespace CeusMedia\SemVerTest;

use CeusMedia\SemVer\Constraint;
use CeusMedia\SemVer\Version;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Constraint
 */
class ConstraintTest extends TestCase
{
	/**
	 *	@covers		::checkVersion
	 */
	public function testCheckVersion(): void
	{
		$e	= new Constraint( '^1 >=1.2.3 <=1.2.5' );
		self::assertFalse( $e->checkVersion( '1' ) );
		self::assertTrue( $e->checkVersion( '1.2.3' ) );
		self::assertTrue( $e->checkVersion( '1.2.4' ) );
		self::assertTrue( $e->checkVersion( '1.2.5' ) );
		self::assertFalse( $e->checkVersion( '1.2.6' ) );

		$e	= new Constraint( '^1 >1.2.3 <1.2.5' );
		self::assertFalse( $e->checkVersion( '1' ) );
		self::assertFalse( $e->checkVersion( '1.2.3' ) );
		self::assertTrue( $e->checkVersion( '1.2.4' ) );
		self::assertFalse( $e->checkVersion( '1.2.5' ) );
		self::assertFalse( $e->checkVersion( '1.2.6' ) );

		$e	= new Constraint( '>=1 <=3' );
		self::assertFalse( $e->checkVersion( '0.9' ) );
		self::assertTrue( $e->checkVersion( '1' ) );
		self::assertTrue( $e->checkVersion( '2' ) );
		self::assertTrue( $e->checkVersion( '2.1' ) );
		self::assertTrue( $e->checkVersion( '3' ) );
		self::assertFalse( $e->checkVersion( '3.1' ) );

		$e	= new Constraint( '>1 <3' );
		self::assertFalse( $e->checkVersion( '0.9' ) );
		self::assertFalse( $e->checkVersion( '1' ) );
		self::assertTrue( $e->checkVersion( '2' ) );
		self::assertTrue( $e->checkVersion( '2.1' ) );
		self::assertFalse( $e->checkVersion( '3' ) );
		self::assertFalse( $e->checkVersion( '3.1' ) );

		$e	= new Constraint( '<=2 || >=4' );
		self::assertTrue( $e->checkVersion( '1' ) );
		self::assertTrue( $e->checkVersion( '2' ) );
		self::assertFalse( $e->checkVersion( '3' ) );
		self::assertTrue( $e->checkVersion( '4' ) );
		self::assertTrue( $e->checkVersion( '5' ) );

		$e	= new Constraint( '<2 || >4' );
		self::assertTrue( $e->checkVersion( '1' ) );
		self::assertFalse( $e->checkVersion( '2' ) );
		self::assertFalse( $e->checkVersion( '3' ) );
		self::assertFalse( $e->checkVersion( '4' ) );
		self::assertTrue( $e->checkVersion( '5' ) );
	}
}

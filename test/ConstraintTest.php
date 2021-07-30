<?php
use CeusMedia\SemVer\Constraint;
use CeusMedia\SemVer\Version;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		CeusMedia\SemVer\Constraint
 */
class ConstraintTest extends TestCase
{
	/**
	 *	@covers		::checkVersion
	 */
	public function testCheckVersion()
	{
		$e	= new Constraint( '^1 >=1.2.3 <=1.2.5' );
		$this->assertFalse( $e->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '1.2.3' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '1.2.4' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '1.2.5' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '1.2.6' ) ) );

		$e	= new Constraint( '^1 >1.2.3 <1.2.5' );
		$this->assertFalse( $e->checkVersion( new Version( '1' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '1.2.3' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '1.2.4' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '1.2.5' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '1.2.6' ) ) );

		$e	= new Constraint( '>=1 <=3' );
		$this->assertFalse( $e->checkVersion( new Version( '0.9' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '2' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '2.1' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '3' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '3.1' ) ) );

		$e	= new Constraint( '>1 <3' );
		$this->assertFalse( $e->checkVersion( new Version( '0.9' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '2' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '2.1' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '3' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '3.1' ) ) );

		$e	= new Constraint( '<=2 || >=4' );
		$this->assertTrue( $e->checkVersion( new Version( '1' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '2' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '3' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '4' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '5' ) ) );

		$e	= new Constraint( '<2 || >4' );
		$this->assertTrue( $e->checkVersion( new Version( '1' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '2' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '3' ) ) );
		$this->assertFalse( $e->checkVersion( new Version( '4' ) ) );
		$this->assertTrue( $e->checkVersion( new Version( '5' ) ) );
	}
}

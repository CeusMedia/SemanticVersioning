<?php
namespace CeusMedia\SemVerTest\Constraint;

use CeusMedia\SemVer\Constraint;
use CeusMedia\SemVer\Constraint\Parser;
use CeusMedia\SemVer\Version;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Constraint\Parser
 */
class ParserTest extends TestCase
{
	/**
	 *	@covers		::parse
	 */
	public function testParse(): void
	{
		$constraint	= Parser::parse( '^1 >=1.2.3 <=1.2.5' );
		self::assertEquals( [], $constraint->ors );
		self::assertEquals( '', $constraint->constraint );

		$expected	= [
			new Constraint( '^1' ),
			new Constraint( '>=1.2.3' ),
			new Constraint( '<=1.2.5' ),
		];
		self::assertEquals( $expected, $constraint->ands );
	}
}

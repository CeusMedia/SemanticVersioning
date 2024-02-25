<?php
namespace CeusMedia\SemVerTest\Version;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Version\Renderer;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Version\Renderer
 */
class RendererTest extends TestCase
{
	/**
	 *	@covers		::render
	 */
	public function testGetAndSetMajor(): void
	{
		$expected	= '1.0.0';
		$version	= ( new Version() )
			->setMajor( 1 );
		$actual		= Renderer::render( $version );
		self::assertEquals( $expected, $actual );

		$expected	= '1.2.0';
		$version	= ( new Version() )
			->setMajor( 1 )
			->setMinor( 2 );
		$actual		= Renderer::render( $version );
		self::assertEquals( $expected, $actual );

		$expected	= '1.2.3';
		$version	= ( new Version() )
			->setMajor( 1 )
			->setMinor( 2 )
			->setPatch( 3 );
		$actual		= Renderer::render( $version );
		self::assertEquals( $expected, $actual );

		$expected	= '1.2.3-4';
		$version	= ( new Version() )
			->setMajor( 1 )
			->setMinor( 2 )
			->setPatch( 3 )
			->setPreRelease( '4' );
		$actual		= Renderer::render( $version );
		self::assertEquals( $expected, $actual );

		$expected	= '1.2.3-4+5';
		$version	= ( new Version() )
			->setMajor( 1 )
			->setMinor( 2 )
			->setPatch( 3 )
			->setPreRelease( '4' )
			->setBuild( 5 );
		$actual		= Renderer::render( $version );
		self::assertEquals( $expected, $actual );

		$expected	= '1.2.3+5';
		$version	= ( new Version() )
			->setMajor( 1 )
			->setMinor( 2 )
			->setPatch( 3 )
			->setBuild( 5 );
		$actual		= Renderer::render( $version );
		self::assertEquals( $expected, $actual );
	}
}

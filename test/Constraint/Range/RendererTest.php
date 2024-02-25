<?php
namespace CeusMedia\SemVerTest\Constraint\Range;

use CeusMedia\SemVer\Constraint\Range;
use CeusMedia\SemVer\Constraint\Range\Renderer;
use CeusMedia\SemVer\Version;
use PHPUnit\Framework\TestCase;

/**
 *	@coversDefaultClass		\CeusMedia\SemVer\Constraint\Range\Renderer
 */
class RendererTest extends TestCase
{
	/**
	 *	@covers		::render
	 */
	public function testRender1(): void
	{
		$constraints	= [
			'1'		=> '1.0.0',
			'>=1'	=> '1.0.0',
			'>1'	=> '1.0.0',
			'<=1'	=> '1.0.0',
			'<1'	=> '1.0.0',
			'^1'	=> '1.0.0',
		];
		foreach( $constraints as $constraint )
			self::assertEquals( $constraint, Renderer::render( Range::create( $constraint ) ) );
	}

	/**
	 *	@covers		::render
	 */
	public function testRender2(): void
	{
		$constraints	= [
			'1.2'	=> '1.2.0',
			'>=1.2'	=> '>=1.2.0',
			'>1.2'	=> '>1.2.0',
			'<=1.2'	=> '<=1.2.0',
			'<1.2'	=> '<1.2.0',
			'^1.2'	=> '^1.2.0',
		];
		foreach( $constraints as $constraint )
			self::assertEquals( $constraint, Renderer::render( Range::create( $constraint ) ) );
	}

	/**
	 *	@covers		::render
	 */
	public function testRender3(): void
	{
		$constraints	= [
			'1.2.3'		=> '1.2.3',
			'>=1.2.3'	=> '>=1.2.3',
			'>1.2.3'	=> '>1.2.3',
			'<=1.2.3'	=> '<=1.2.3',
			'<1.2.3'	=> '<1.2.3',
			'^1.2.3'	=> '^1.2.3',
		];
		foreach( $constraints as $constraint )
			self::assertEquals( $constraint, Renderer::render( Range::create( $constraint ) ) );
	}
}

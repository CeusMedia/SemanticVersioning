<?php
namespace CeusMedia\SemVer\Version;

use CeusMedia\SemVer\Version;

class Renderer
{
	public static function render( Version $version ): string
	{
		$string	= vsprintf( '%d.%d.%d', [
			$version->getMajor(),
			$version->getMinor(),
			$version->getPatch()
		] );
		if( 0 !== strlen( $version->getPreRelease() ) )
			$string	.= '-'.$version->getPreRelease();
		if( $version->getBuild() > 0 )
			$string	.= '+'.$version->getBuild();
		return $string;
	}
}

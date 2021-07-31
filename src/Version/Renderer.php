<?php
namespace CeusMedia\SemVer\Version;

use CeusMedia\SemVer\Version;

class Renderer
{
	public static function render( Version $version ): string
	{
		$string	= vsprintf( '%d.%d.%d', array(
			$version->getMajor(),
			$version->getMinor(),
			$version->getPatch()
		) );
		if( strlen( $version->getPreRelease() ) > 0 ){
			$string	.= '-'.$version->getPreRelease();
		}
		if( $version->getBuild() > 0 ){
			$string	.= '+'.$version->getBuild();
		}
		return $string;
	}
}

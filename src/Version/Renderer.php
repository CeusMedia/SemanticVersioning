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
		if( $version->getPreRelease() ){
			$string	.= '-'.$version->getPreRelease();
		}
		if( $version->getBuild() ){
			$string	.= '+'.$version->getBuild();
		}
		return $string;
	}
}

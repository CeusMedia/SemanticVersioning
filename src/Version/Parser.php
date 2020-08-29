<?php
namespace CeusMedia\SemVer\Version;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Exception;

class Parser
{
	protected static $regExp	= '/^v?(\d+)(\.(\d+))?(\.(\d+))?(-([^+]+))?(\+(.+))?$/u';

	public static function parse( $versionString )
	{
		$matches	= array();
		if( !preg_match( static::$regExp, $versionString, $matches ) ){
			throw new Exception( 'Given string is not a valid SemVer version' );
		}
		$version	= new Version();
		$version->setMajor( (int) $matches[1] );
		if( !empty( $matches[3] ) )
			$version->setMinor( (int) $matches[3] );
		if( !empty( $matches[5] ) )
			$version->setPatch( (int) $matches[5] );
		if( !empty( $matches[7] ) )
			$version->setPreRelease( $matches[7] );
		if( !empty( $matches[9] ) )
			$version->setBuild( (int) $matches[9] );
		return $version;
	}
}

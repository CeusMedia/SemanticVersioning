<?php
namespace CeusMedia\SemVer\Version;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Exception;

class Parser
{
	/** @var	string */
	protected static string $regExp	= '/^v?(\d+)(\.(\d+))?(\.(\d+))?(-([^+]+))?(\+(.+))?$/u';

	public static function parse( string $versionString ): Version
	{
		if( !self::isValid( $versionString ) )
			throw new Exception( 'Given string is not a valid SemVer version' );

		preg_match( static::$regExp, $versionString, $matches );

		$version	= new Version();
		$version->setMajor( (int) $matches[1] );
		if( isset( $matches[3] ) )
			$version->setMinor( (int) $matches[3] );
		if( isset( $matches[5] ) )
			$version->setPatch( (int) $matches[5] );
		if( isset( $matches[7] ) )
			$version->setPreRelease( $matches[7] );
		if( isset( $matches[9] ) )
			$version->setBuild( (int) $matches[9] );
		return $version;
	}

	public static function isValid( string $versionString ): bool
	{
		return 0 !== preg_match( static::$regExp, $versionString );
	}
}

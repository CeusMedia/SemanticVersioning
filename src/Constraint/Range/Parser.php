<?php
namespace CeusMedia\SemVer\Constraint\Range;

use CeusMedia\SemVer\Constraint\Range;
use CeusMedia\SemVer\Version;

class Parser
{
	public static function parse( string $constraint ): Range
	{
		$range		= new Range();
		$matches	= [];
		if( preg_match( '/^(\D+)(\d.*)$/', $constraint, $matches ) !== 0 ){
			$operator	= $matches[1];
			$version	= $matches[2];
//			print( 'Operator: '.$operator.PHP_EOL );
//			print( 'Version:  '.$version.PHP_EOL );
			switch( $operator ){
				case '^':
					$level	= substr_count( $constraint, '.' ) + 1;
//					print( 'Range->parseConstraint: level -> '.$level.PHP_EOL );
					$range->setAtLeast( new Version( $version ) );
					$maxVersion	= new Version( $version );
					if( $level === 1 )
						$maxVersion->incrementMajor();
					else if( $level === 2 )
						$maxVersion->incrementMinor();
					else if( $level === 3 )
						$maxVersion->incrementPatch();
					$range->setLowerThan( $maxVersion );
					break;
				case '>=':
					$range->setAtLeast( new Version( $version ) );
					break;
				case '<=':
					$range->setAtMost( new Version( $version ) );
					break;
				case '>':
					$range->setGreaterThan( new Version( $version ) );
					break;
				case '<':
					$range->setLowerThan( new Version( $version ) );
					break;
			}
		}
		else if( preg_match( '/^(\d.*)-(\d.*)$/', $constraint, $matches ) !== 0 ){
			$range->setAtLeast( new Version( $matches[1] ) );
			$range->setAtMost( new Version( $matches[2] ) );
		}
		else{
			$range->setAtLeast( new Version( $constraint ) );
			$range->setAtMost( new Version( $constraint ) );
		}
		return $range;
	}
}

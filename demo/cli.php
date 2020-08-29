<?php
require_once 'vendor/autoload.php';

/**
 *	@see	https://semver.org/
 *	@see	https://devhints.io/semver
 *	@see	https://github.com/vierbergenlars/php-semver
 */

use CeusMedia\SemVer\Expression;
use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Expression\Range;
use CeusMedia\SemVer\Expression\Satisfier;

$s	= new Satisfier();

die;

/*
$v = new Version( '1.2.3-alpha+4567' );
print( 'Version: '.$v.PHP_EOL );
print_r( $v );
print( 'IncPatch: '.$v->incrementPatch().PHP_EOL );
print( 'IncMinor: '.$v->incrementMinor().PHP_EOL );
print( 'IncMajor: '.$v->incrementMajor().PHP_EOL );
print( '---------------------------------'.PHP_EOL );


$v1	= new Version( '2.0.0-alpha.1' );
$v2	= new Version( '2.0.0' );

print( 'v1: '.$v1.PHP_EOL );
print( 'v2: '.$v2.PHP_EOL );
print( 'isGreater: '.( $v1->isGreaterThan( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
print( 'isLower: '.( $v1->isLowerThan( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
print( 'isAtleast: '.( $v1->isAtLeast( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
print( 'isAtMost: '.( $v1->isAtMost( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
print( 'equals: '.( $v1->isEqualTo( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
print( 'differs: '.( $v1->isDifferentFrom( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
print( '---------------------------------'.PHP_EOL );
*/
$e = new Expression( '^1.2 || ^1.3 >1.2' );
print_r( $e );
/*
Satisfier::satisfies( $v, new Range( '^1' ) );


die;

$s->compare( '1.2.3-alpha+4567', '' );
*/

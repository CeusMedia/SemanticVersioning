<?php
require_once __DIR__.'/../vendor/autoload.php';

/**
 *	@see	https://semver.org/
 *	@see	https://devhints.io/semver
 *	@see	https://github.com/vierbergenlars/php-semver
 */

use CeusMedia\SemVer\Constraint;
use CeusMedia\SemVer\Constraint\Range;
use CeusMedia\SemVer\Constraint\Range\Renderer;
use CeusMedia\SemVer\Constraint\Satisfier as ConstraintSatisfier;
use CeusMedia\SemVer\Version;

$test1	= !TRUE;
$test2	= !TRUE;
$test3	= !TRUE;
$test4	= TRUE;
$test5	= !TRUE;
$test5	= !TRUE;

if( $test1 ?? FALSE ){
	$v = new Version( '1' );
	print( 'Version: '.$v.PHP_EOL );
	print_r( $v );
	print( 'IncPatch: '.$v->incrementPatch().PHP_EOL );
	print( 'IncMinor: '.$v->incrementMinor().PHP_EOL );
	print( 'IncMajor: '.$v->incrementMajor().PHP_EOL );
	print( '---------------------------------'.PHP_EOL );
}
if( $test2 ?? FALSE ){
	$v = new Version( '1.2.3-alpha+4567' );
	print( 'Version: '.$v.PHP_EOL );
	print_r( $v );
	print( 'IncPatch: '.$v->incrementPatch().PHP_EOL );
	print( 'IncMinor: '.$v->incrementMinor().PHP_EOL );
	print( 'IncMajor: '.$v->incrementMajor().PHP_EOL );
	print( '---------------------------------'.PHP_EOL );
}
if( $test3 ?? FALSE ){
	$v1	= new Version( '2.0.0-alpha.1' );
	$v2	= new Version( '2.0.0' );

	print( 'v1: '.$v1.PHP_EOL );
	print( 'v2: '.$v2.PHP_EOL );
	print( 'isGreater: '.( $v1->isGreaterThan( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
	print( 'isLower: '.( $v1->isLowerThan( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
	print( 'isAtLeast: '.( $v1->isAtLeast( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
	print( 'isAtMost: '.( $v1->isAtMost( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
	print( 'equals: '.( $v1->isEqualTo( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
	print( 'differs: '.( $v1->isDifferentFrom( $v2 ) ? 'yes' : 'no' ).PHP_EOL );
	print( '---------------------------------'.PHP_EOL );
}
if( $test4 ?? FALSE ){
	$r	= new Range( '>=1.2' );
	print( 'r: '.Renderer::render( $r ).PHP_EOL );
	print( '1.0.0? '.( $r->checkVersion( '1.0.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '1.1.0? '.( $r->checkVersion( '1.1.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '1.2.0? '.( $r->checkVersion( '1.2.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '1.3.0? '.( $r->checkVersion( '1.3.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '2.0.0? '.( $r->checkVersion( '2.0.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '---------------------------------'.PHP_EOL );
	$r	= new Range( '^1.2' );
	print( 'r: '.Renderer::render( $r ).PHP_EOL );
	print( '1.0.0? '.( $r->checkVersion( '1.0.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '1.1.0? '.( $r->checkVersion( '1.1.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '1.2.0? '.( $r->checkVersion( '1.2.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '1.3.0? '.( $r->checkVersion( '1.3.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '2.0.0? '.( $r->checkVersion( '2.0.0' ) ? 'yes' : 'no' ).PHP_EOL );
	print( '---------------------------------'.PHP_EOL );
}
if( $test5 ?? FALSE ){
	$c = new Constraint( '^1.2 || ^1.3 >1.2' );
	$c->getConstraint();
	print_r( $c );
	print( '---------------------------------'.PHP_EOL );
}
if( $test6 ?? FALSE ){
	ConstraintSatisfier::satisfies( $v, new Range( '^1' ) );
	$s	= new ConstraintSatisfier();
	$s->compare( '1.2.3-alpha+4567', '' );
	print( '---------------------------------'.PHP_EOL );
}

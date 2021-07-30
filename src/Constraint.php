<?php
namespace CeusMedia\SemVer;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Constraint\Range as ConstraintRange;

class Constraint
{
	protected $constraint;
	protected $ors				= array();
	protected $ands				= array();

	public function __construct( string $constraint )
	{
//		print( 'Parsing exp: '.$constraint.PHP_EOL );
		$constraint	= preg_replace( '/\s*\|\|\s*/', '||', $constraint );
		$constraint	= preg_replace( '/\s*&&\s*/', '&&', $constraint );
		$constraint	= preg_replace( '/\s+/', '&&', $constraint );
		if( preg_match( '/\|\|/', $constraint ) ){
			foreach( preg_split( '/\|\|/', $constraint ) as $subConstraint ){
				$this->ors[] = new Constraint( $subConstraint );
			}
		}
		else if( preg_match( '/&&/', $constraint ) ){
			foreach( preg_split( '/&&/', $constraint ) as $subConstraint ){
				$this->ands[] = new Constraint( $subConstraint );
			}
		}
		else {
			$this->constraint	= $constraint;
		}
	}

	public function checkVersion( Version $version ): bool
	{
		if( $this->ands ){
			$valid	= TRUE;
			foreach( $this->ands as $constraint )
				$valid	= $valid && $constraint->checkVersion( $version );
			return $valid;
		}
		else if( $this->ors ){
			$valid	= FALSE;
			foreach( $this->ors as $constraint )
				$valid	= $valid || $constraint->checkVersion( $version );
			return $valid;
		}
		else{
			$range	= new ConstraintRange( $this->constraint );
			return $range->checkVersion( $version );
		}
	}
}

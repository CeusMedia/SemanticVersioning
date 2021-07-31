<?php
namespace CeusMedia\SemVer;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Constraint\Range as ConstraintRange;

class Constraint
{
	/** @var	string */
	protected $constraint;

	/** @var	Constraint[] */
	protected $ors				= array();

	/** @var	Constraint[] */
	protected $ands				= array();

	public function __construct( string $constraint )
	{
		$constraint	= (string) preg_replace( '/\s*\|\|\s*/', '||', $constraint );
		$constraint	= (string) preg_replace( '/\s*&&\s*/', '&&', $constraint );
		$constraint	= (string) preg_replace( '/\s+/', '&&', $constraint );
		if( preg_match( '/\|\|/', $constraint ) !== 0 ){
			$splits	= preg_split( '/\|\|/', $constraint );
			if( $splits !== FALSE )
				foreach( $splits as $subConstraint )
					$this->ors[] = new Constraint( $subConstraint );
		}
		else if( preg_match( '/&&/', $constraint ) !== 0 ){
			$splits	= preg_split( '/&&/', $constraint );
			if( $splits !== FALSE )
				foreach( $splits as $subConstraint )
					$this->ands[] = new Constraint( $subConstraint );
		}
		else {
			$this->constraint	= $constraint;
		}
	}

	public function checkVersion( Version $version ): bool
	{
		if( count( $this->ands ) > 0 ){
			$valid	= TRUE;
			foreach( $this->ands as $constraint )
				$valid	= $valid && $constraint->checkVersion( $version );
			return $valid;
		}
		else if( count( $this->ors ) > 0 ){
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

	/**
	 *	@return		Constraint[]
	 */
	public function getAnds(): array
	{
		return $this->ands;
	}

	public function getConstraint(): string
	{
		return $this->constraint;
	}

	/**
	 *	@return		Constraint[]
	 */
	public function getOrs(): array
	{
		return $this->ands;
	}
}

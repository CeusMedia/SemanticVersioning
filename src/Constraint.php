<?php
namespace CeusMedia\SemVer;

use CeusMedia\SemVer\Constraint\Parser as ConstraintParser;
use CeusMedia\SemVer\Constraint\Range as ConstraintRange;

class Constraint
{
	/** @var	string */
	public string $constraint	= '';

	/** @var	Constraint[] */
	public array $ors			= [];

	/** @var	Constraint[] */
	public array $ands			= [];

	public function __construct( ?string $constraint = NULL )
	{
		if( NULL !== $constraint ){
			$object	= ConstraintParser::parse( $constraint );
			$this->ors			= $object->ors;
			$this->ands			= $object->ands;
			$this->constraint	= $object->constraint;
		}
	}

	public function checkVersion( Version|string $version ): bool
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

	/**
	 *	@return		string
	 */
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

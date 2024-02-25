<?php
namespace CeusMedia\SemVer\Constraint;

use CeusMedia\SemVer\Constraint;

class Parser
{
	public static function parse( string $constraint ): Constraint
	{
		$object = new Constraint();
		$constraint	= (string) preg_replace( '/\s*\|\|\s*/', '||', $constraint );
		$constraint	= (string) preg_replace( '/\s*&&\s*/', '&&', $constraint );
		$constraint	= (string) preg_replace( '/\s+/', '&&', $constraint );
		if( str_contains( $constraint, '||' ) )
			foreach( explode( '||', $constraint ) as $subConstraint )
				$object->ors[] = new Constraint( $subConstraint );
		else if( str_contains( $constraint, '&&' ) )
			foreach( explode( '&&', $constraint ) as $subConstraint )
				$object->ands[] = new Constraint( $subConstraint );
		else
			$object->constraint	= $constraint;
		return $object;
	}
}

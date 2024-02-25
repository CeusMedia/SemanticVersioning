<?php
namespace CeusMedia\SemVer\Constraint\Range;

use CeusMedia\SemVer\Constraint\Range;

class Renderer
{
	public static function render( Range $range ): string
	{
		if( NULL !== $range->getAtLeast() && NULL !== $range->getAtMost() ){
			if( !$range->getAtLeast()->isDifferentFrom( $range->getAtMost() ) )
				return $range->getAtLeast();
			return $range->getAtLeast().'-'.$range->getAtMost();
		}
		if( NULL !== $range->getAtLeast() && NULL !== $range->getLowerThan() )
			return '^'.$range->getAtLeast();
		if( NULL !== $range->getAtLeast() )
			return '>='.$range->getAtLeast();
		if( NULL !== $range->getAtMost() )
			return '<='.$range->getAtMost();
		if( NULL !== $range->getLowerThan() )
			return '<'.$range->getLowerThan();
		if( NULL !== $range->getGreaterThan() )
			return '>'.$range->getGreaterThan();
		return '';
	}
}

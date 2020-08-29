<?php
namespace CeusMedia\SemVer;

use CeusMedia\SemVer\Version;
use CeusMedia\SemVer\Expression\Range as ExpressionRange;

class Expression
{
	protected $expression;
	protected $ors				= array();
	protected $ands				= array();

	public function __construct( string $expression )
	{
//		print( 'Parsing exp: '.$expression.PHP_EOL );
		$expression	= preg_replace( '/\s*\|\|\s*/', '||', $expression );
		$expression	= preg_replace( '/\s*&&\s*/', '&&', $expression );
		$expression	= preg_replace( '/\s+/', '&&', $expression );
		if( preg_match( '/\|\|/', $expression ) ){
			foreach( preg_split( '/\|\|/', $expression ) as $subExpression ){
				$this->ors[] = new Expression( $subExpression );
			}
		}
		else if( preg_match( '/&&/', $expression ) ){
			foreach( preg_split( '/&&/', $expression ) as $subExpression ){
				$this->ands[] = new Expression( $subExpression );
			}
		}
		else {
			$this->expression	= $expression;
		}
	}

	public function checkVersion( Version $version ): bool
	{
		if( $this->ands ){
			$valid	= TRUE;
			foreach( $this->ands as $expression )
				$valid	= $valid && $expression->checkVersion( $version );
			return $valid;
		}
		else if( $this->ors ){
			$valid	= FALSE;
			foreach( $this->ors as $expression )
				$valid	= $valid || $expression->checkVersion( $version );
			return $valid;
		}
		else{
			$range	= new ExpressionRange( $this->expression );
			return $range->checkVersion( $version );
		}
	}
}

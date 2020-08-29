<?php
namespace CeusMedia\SemVer\Version;

use CeusMedia\SemVer\Expression;
use CeusMedia\SemVer\Version;

class Set
{
	protected $list		= array();

	public function __construct( array $list = array() )
	{
		if( count( $list ) ){
			foreach( self::fromList( $list ) as $item ){
				$this->list[]	= $item;
			}
		}
	}

	public function add( Version $version ): self
	{
		$this->list[]	= $version;
		return $this;
	}

	public function applyExpression( Expression $expression ): Set
	{
		$set	= new static();
		foreach( $this->list as $version ){
			if( $expression->checkVersion( $version ) )
				$set->add( $version );
		}
		return $set;
	}

	public static function fromArray( array $array ): Set
	{
		$set	= new static();
		foreach( $list as $version ){
			if( is_string( $version ) )
				$version	= new Version( $version );
			if( !( $version instanceof Version ) )
				throw new \InvalidArgumentException( 'List item is neither a version not a string' );
			$set->add( $version );
		}
		return $set;
	}
}

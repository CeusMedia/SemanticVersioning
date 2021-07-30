<?php
namespace CeusMedia\SemVer\Version;

use CeusMedia\SemVer\Constraint;
use CeusMedia\SemVer\Version;

class Set
{
	protected $list		= array();

	public function __construct( array $list = array() )
	{
		if( count( $list ) ){
			foreach( self::fromList( $list )->getList() as $item ){
				$this->list[]	= $item;
			}
		}
	}

	public function add( Version $version ): self
	{
		$this->list[]	= $version;
		return $this;
	}

	public function applyConstraint( Constraint $constraint ): Set
	{
		$set	= new self();
		foreach( $this->list as $version ){
			if( $constraint->checkVersion( $version ) )
				$set->add( $version );
		}
		return $set;
	}

	public static function fromList( array $list ): Set
	{
		$set	= new self();
		foreach( $list as $version ){
			if( is_string( $version ) )
				$version	= new Version( $version );
			if( !( $version instanceof Version ) )
				throw new \InvalidArgumentException( 'List item is neither a version not a string' );
			$set->add( $version );
		}
		return $set;
	}

	public function getList(): array
	{
		return $this->list;
	}
}

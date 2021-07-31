<?php
namespace CeusMedia\SemVer\Version;

use CeusMedia\SemVer\Constraint;
use CeusMedia\SemVer\Version;

class Set
{
	/** @var	Version[] */
	protected $list		= array();

	/**
	 *	@param		Version[]		$list
	 */
	public function __construct( array $list = array() )
	{
		if( count( $list ) > 0 ){
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

	/**
	 *	@param		array<Version|string>		$list
	 */
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

	/**
	 *	@return		Version[]
	 */
	public function getList(): array
	{
		return $this->list;
	}
}

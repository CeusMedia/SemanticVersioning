<?php
namespace CeusMedia\SemVer\Constraint;

use CeusMedia\SemVer\Constraint\Range\Parser;
use CeusMedia\SemVer\Version;

class Range
{
	/** @var	Version|NULL */
	protected ?Version $atLeast		= NULL;

	/** @var	Version|NULL */
	protected ?Version $atMost		= NULL;

	/** @var	Version|NULL */
	protected ?Version $greaterThan	= NULL;

	/** @var	Version|NULL */
	protected ?Version $lowerThan	= NULL;

	public static function create( ?string $constraint = NULL ): self
	{
		return new self( $constraint );
	}

	public function __construct( string $constraint = NULL )
	{
		if( !is_null( $constraint ) ){
			$range	= Parser::parse( $constraint );
			$this->setAtLeast( $range->getAtLeast() );
			$this->setAtMost( $range->getAtMost() );
			$this->setGreaterThan( $range->getGreaterThan() );
			$this->setLowerThan( $range->getLowerThan() );
		}
	}

	public function checkVersion( Version|string $version ): bool
	{
		$version	= is_string( $version ) ? new Version( $version ) : $version;
		if( !is_null( $this->atLeast ) && !is_null( $this->atMost ) ){
			if( $this->atLeast->render() === $this->atMost->render() && !$version->isEqualTo( $this->atLeast ) )
				return FALSE;
		}
		if( !is_null( $this->atLeast ) && $version->isLowerThan( $this->atLeast ) )
			return FALSE;
		if( !is_null( $this->atMost ) && $version->isGreaterThan( $this->atMost ) )
			return FALSE;
		if( !is_null( $this->greaterThan ) && $version->isAtMost( $this->greaterThan ) )
			return FALSE;
		if( !is_null( $this->lowerThan ) && $version->isAtLeast( $this->lowerThan ) )
			return FALSE;
		return TRUE;
	}

	public function getAtLeast(): ?Version
	{
		return $this->atLeast;
	}

	public function getAtMost(): ?Version
	{
		return $this->atMost;
	}

	public function getGreaterThan(): ?Version
	{
		return $this->greaterThan;
	}

	public function getLowerThan(): ?Version
	{
		return $this->lowerThan;
	}

	/**
	 *	@param		string		$constraint
	 *	@return		Range
	 *	@deprecated	use Parser::parse instead
	 */
	public static function parseConstraint( string $constraint ): Range
	{
		return Parser::parse( $constraint );
	}

	public function setAtLeast( Version|string|NULL $version ): self
	{
		$this->atLeast	= is_string( $version ) ? new Version( $version ) : $version;
		return $this;
	}

	public function setAtMost( Version|string|NULL $version ): self
	{
		$this->atMost	= is_string( $version ) ? new Version( $version ) : $version;
		return $this;
	}

	public function setGreaterThan( Version|string|NULL $version ): self
	{
		$this->greaterThan	= is_string( $version ) ? new Version( $version ) : $version;
		return $this;
	}

	public function setLowerThan( Version|string|NULL $version ): self
	{
		$this->lowerThan	= is_string( $version ) ? new Version( $version ) : $version;
		return $this;
	}
}

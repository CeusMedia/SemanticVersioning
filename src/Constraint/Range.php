<?php
namespace CeusMedia\SemVer\Constraint;

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

	public function __construct( string $constraint = NULL )
	{
		if( !is_null( $constraint ) ){
			$range	= self::parseConstraint( $constraint );
			$this->setAtLeast( $range->getAtLeast() );
			$this->setAtMost( $range->getAtMost() );
			$this->setGreaterThan( $range->getGreaterThan() );
			$this->setLowerThan( $range->getLowerThan() );
		}
	}

	public function checkVersion( Version $version ): bool
	{
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

	public static function parseConstraint( string $constraint ): Range
	{
		$range		= new Range();
		$version	= $constraint;
		$matches	= array();
		if( preg_match( '/^(\D+)(\d.*)$/', $constraint, $matches ) !== 0 ){
			$operator	= $matches[1];
			$version	= $matches[2];
//			print( 'Operator: '.$operator.PHP_EOL );
//			print( 'Version:  '.$version.PHP_EOL );
			switch( $operator ){
				case '^':
					$level	= substr_count( $constraint, '.' ) + 1;
//					print( 'Range->parseConstraint: level -> '.$level.PHP_EOL );
					$range->setAtLeast( new Version( $version ) );
					$maxVersion	= new Version( $version );
					if( $level === 1 )
						$maxVersion->incrementMajor();
					else if( $level === 2 )
						$maxVersion->incrementMinor();
					else if( $level === 3 )
						$maxVersion->incrementPatch();
					$range->setLowerThan( $maxVersion );
					break;
				case '>=':
					$range->setAtLeast( new Version( $version ) );
					break;
				case '<=':
					$range->setAtMost( new Version( $version ) );
					break;
				case '>':
					$range->setGreaterThan( new Version( $version ) );
					break;
				case '<':
					$range->setLowerThan( new Version( $version ) );
					break;
			}
		}
		else if( preg_match( '/^(\d.*)-(\d.*)$/', $constraint, $matches ) !== 0 ){
			$range->setAtLeast( new Version( $matches[1] ) );
			$range->setAtMost( new Version( $matches[2] ) );
		}
		else{
			$range->setAtLeast( new Version( $constraint ) );
			$range->setAtMost( new Version( $constraint ) );
		}
		return $range;
	}

	public function setAtLeast( ?Version $version ): self
	{
		$this->atLeast	= $version;
		return $this;
	}

	public function setAtMost( ?Version $version ): self
	{
		$this->atMost	= $version;
		return $this;
	}

	public function setGreaterThan( ?Version $version ): self
	{
		$this->greaterThan	= $version;
		return $this;
	}

	public function setLowerThan( ?Version $version ): self
	{
		$this->lowerThan	= $version;
		return $this;
	}
}

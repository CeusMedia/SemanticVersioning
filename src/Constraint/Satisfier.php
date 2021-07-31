<?php
namespace CeusMedia\SemVer\Constraint;

use CeusMedia\SemVer\Constraint\Range;
use CeusMedia\SemVer\Version;
use InvalidArgumentException;

class Satisfier
{
	const STRATEGY_OLDEST		= 1;
	const STRATEGY_LATEST		= 2;
	const STRATEGY_LATEST_PATCH	= 3;
	const STRATEGY_LATEST_MINOR	= 4;
	const STRATEGY_LATEST_MAJOR	= 5;

	const STRATEGIES			= [
		self::STRATEGY_OLDEST,
		self::STRATEGY_LATEST,
		self::STRATEGY_LATEST_PATCH,
		self::STRATEGY_LATEST_MINOR,
		self::STRATEGY_LATEST_MAJOR,
	];

	/** @var	integer */
	protected $strategy		= self::STRATEGY_LATEST;

	/**
	 *	@todo			implement
	 */
	public static function satisfies( Version $version, Range $range ): bool
	{
		return FALSE;
	}

	public function getStrategy(): int
	{
		return $this->strategy;
	}

	public function setStrategy( int $strategy ): self
	{
		if( !in_array( $strategy, self::STRATEGIES, TRUE ) )
			throw new InvalidArgumentException( 'Invalid strategy' );
		$this->strategy	= $strategy;
		return $this;
	}
}

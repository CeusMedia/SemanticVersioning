<?php
namespace CeusMedia\SemVer\Version;

class Comparator
{
	public static function differs( string $v1, string $v2 ): bool
	{
		return version_compare( $v1, $v2, 'ne' );
	}

	public static function equals( string $v1, string $v2 ): bool
	{
		return version_compare( $v1, $v2, 'eq' );
	}

	public static function isAtLeast( string $v1, string $v2 ): bool
	{
		return version_compare( $v1, $v2, 'ge' );
	}

	public static function isAtMost( string $v1, string $v2 ): bool
	{
		return version_compare( $v1, $v2, 'le' );
	}
	public static function isGreater( string $v1, string $v2 ): bool
	{
		return version_compare( $v1, $v2, 'gt' );
	}

	public static function isLower( string $v1, string $v2 ): bool
	{
		return version_compare( $v1, $v2, 'lt' );
	}
}

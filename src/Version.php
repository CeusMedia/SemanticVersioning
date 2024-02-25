<?php
namespace CeusMedia\SemVer;

use CeusMedia\SemVer\Version\Comparator as VersionComparator;
use CeusMedia\SemVer\Version\Parser as VersionParser;
use CeusMedia\SemVer\Version\Renderer as VersionRenderer;
use Stringable;

class Version implements Stringable
{
	/** @var	integer */
	protected int $major		= 0;

	/** @var	integer */
	protected int $minor		= 0;

	/** @var	integer */
	protected int $patch		= 0;

	/** @var	string */
	protected string $preRelease	= '';

	/** @var	integer */
	protected int $build		= 0;

	public static function fromString( string $versionString ): self
	{
		return VersionParser::parse( $versionString );
	}

	public function __construct( ?string $versionString = NULL )
	{
		if( $versionString !== NULL && strlen( trim( $versionString ) ) > 0 ){
			$version	= self::fromString( $versionString );
			$this->setMajor( $version->getMajor() );
			$this->setMinor( $version->getMinor() );
			$this->setPatch( $version->getPatch() );
			$this->setPreRelease( $version->getPreRelease() );
			$this->setBuild( $version->getBuild() );
		}
	}

	public function __toString(): string
	{
		return $this->render();
	}

	public function getBuild(): int
	{
		return $this->build;
	}

	public function getMajor(): int
	{
		return $this->major;
	}

	public function getMinor(): int
	{
		return $this->minor;
	}

	public function getPatch(): int
	{
		return $this->patch;
	}

	public function getPreRelease(): string
	{
		return $this->preRelease;
	}

	public function incrementMajor(): self
	{
		$this->major		+= 1;
		$this->minor		= 0;
		$this->patch		= 0;
		$this->build		= 0;
		$this->preRelease	= '';
		return $this;
//		return new Version( $this->major + 1 );
	}

	public function incrementMinor(): self
	{
		$this->minor		+= 1;
		$this->patch		= 0;
		$this->build		= 0;
		$this->preRelease	= '';
		return $this;
//		return new Version( vsprintf( '%d.%d', array(
//			$this->major,
//			$this->minor + 1,
//		) ) );
	}

	public function incrementPatch(): self
	{
		$this->patch		+= 1;
		$this->build		= 0;
		$this->preRelease	= '';
		return $this;
//		return new Version( vsprintf( '%d.%d.%d', array(
//			$this->major,
//			$this->minor,
//			$this->patch + 1
//		) ) );
	}

	public function incrementBuild(): self
	{
		$this->build		+= 1;
		$this->preRelease	= '';
		return $this;
	}

	public function isAtLeast( Version $version ): bool
	{
		return VersionComparator::isAtLeast( $this, $version );
	}

	public function isAtMost( Version $version ): bool
	{
		return VersionComparator::isAtMost( $this, $version );
	}

	public function isDifferentFrom( Version $version ): bool
	{
		return VersionComparator::differs( $this, $version );
	}

	public function isEqualTo( Version $version ): bool
	{
		return VersionComparator::equals( $this, $version );
	}

	public function isGreaterThan( Version $version ): bool
	{
		return VersionComparator::isGreater( $this, $version );
	}

	public function isLowerThan( Version $version ): bool
	{
		return VersionComparator::isLower( $this, $version );
	}

	public function isPublic(): bool
	{
		return $this->major > 0;
	}

	public function isStable(): bool
	{
		return $this->isPublic() && $this->preRelease === '';
	}

	public static function parse( string $versionString ): Version
	{
		return VersionParser::parse( $versionString );
	}

	public function render(): string
	{
		return VersionRenderer::render( $this );
	}

	public function satifies( Constraint $constraint ): bool
	{
		return $constraint->checkVersion( $this );
	}

	public function setMajor( int $major ): self
	{
		$this->major	= $major;
		return $this;
	}

	public function setMinor( int $minor ): self
	{
		$this->minor	= $minor;
		return $this;
	}

	public function setPatch( int $patch ): self
	{
		$this->patch	= $patch;
		return $this;
	}

	public function setPreRelease( string $preRelease ): self
	{
		$this->preRelease	= $preRelease;
		return $this;
	}

	public function setBuild( int $build ): self
	{
		$this->build	= $build;
		return $this;
	}

}

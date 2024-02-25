# Semantic Versioning

![Branch](https://img.shields.io/badge/Branch-0.2.x-blue?style=flat-square)
![Release](https://img.shields.io/badge/Release-0.2-blue?style=flat-square)
![PHP version](https://img.shields.io/badge/PHP-%5E8.1-blue?style=flat-square&color=777BB4)
![PHPStan level](https://img.shields.io/badge/PHPStan_level-max+strict-darkgreen?style=flat-square)

Simple (and by now incomplete) implementation of [Semantic Versioning][1] for PHP 8.

## Installation

````composer require ceus-media/semantic-versioning````

### Usage

Create a version and manipulate:
```php
$v = new Version( '1.2.3' );
$v->incrementPatch();  //  --> 1.2.4
$v->incrementMinor();  //  --> 1.3.0
$v->incrementMajor();  //  --> 2.0.0
```

Compare versions:
```php
$v1 = new Version( '1.2.3' );
$v2 = new Version( '1.2.4' );
$v2->isLowerThan( $v1 );      //  -->  no
$v2->isGreaterThan( $v1 );    //  -->  yes
$v2->isAtLeast( $v1 );        //  -->  yes
$v2->isAtMost( $v1 );         //  -->  no
$v2->isEqualTo( $v1 );        //  -->  no
$v2->isDifferentFrom( $v1 );  //  -->  yes
```

Define ranges and compare :
```php
$r	= new Range( '^1.2' );
Renderer::render( $r );      //  -> '^1.2.0
$r->checkVersion( '1.0.0' )  //  --> n;
$r->checkVersion( '1.1.0' )  //  --> n;
$r->checkVersion( '1.2.0' )  //  --> y;
$r->checkVersion( '1.3.0' )  //  --> n;
$r->checkVersion( '2.0.0' )  //  --> n;
```

Constraints:
```
... to be documented
```

----
[1]: https://semver.org/

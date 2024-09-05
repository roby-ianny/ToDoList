<?php

namespace Phpactor\WorseReflection\Tests\Unit\Core;

use PHPUnit\Framework\TestCase;
use Phpactor\WorseReflection\Core\Type;
use Phpactor\WorseReflection\Core\ClassName;
use Phpactor\WorseReflection\Core\Name;
use stdClass;

class TypeTest extends TestCase
{
    /**
     * @testdox It should __toString the given type.
     * @dataProvider provideToString
     */
    public function testToString(Type $type, $toString, $phpType): void
    {
        $this->assertEquals($toString, (string) $type, '__toString()');

        if ($type->isDefined()) {
            $this->assertEquals($phpType, $type->primitive(), 'primitive (phptype)');
        }
    }

    public function provideToString()
    {
        yield [
            Type::fromString('string'),
            'string',
            'string',
        ];

        yield [
            Type::fromString('float'),
            'float',
            'float',
        ];

        yield [
            Type::fromString('int'),
            'int',
            'int',
        ];

        yield [
            Type::fromString('bool'),
            'bool',
            'bool',
        ];

        yield [
            Type::fromString('array'),
            'array',
            'array',
        ];

        yield [
            Type::fromString('void'),
            'void',
            'void',
        ];

        yield [
            Type::fromString('Foobar'),
            'Foobar',
            'object'
        ];

        yield [
            Type::fromString('mixed'),
            '<unknown>',
            '<unknown>'
        ];

        yield 'Collection' => [
            Type::collection('Foobar', Type::string()),
            'Foobar<string>',
            'object',
        ];

        yield 'Typed array' => [
            Type::array('string'),
            'string[]',
            'array',
        ];

        yield 'Nullable string' => [
            Type::fromString('?string'),
            '?string',
            '?string',
        ];

        yield 'Nullable class' => [
            Type::fromString('?Foobar'),
            '?Foobar',
            '?object',
        ];

        yield 'Nullable iterable class' => [
            Type::fromString('?Foo<Bar>'),
            '?Foo<Bar>',
            '?object',
        ];

        yield 'callable' => [
            Type::fromString('callable'),
            'callable',
            'callable'
        ];

        yield 'iterable' => [
            Type::fromString('iterable'),
            'iterable',
            'iterable'
        ];

        yield 'resource' => [
            Type::fromString('resource'),
            'resource',
            'resource'
        ];
    }

    /**
     * @testdox It returns the short name for a class.
     */
    public function testShort(): void
    {
        $type = Type::fromString('Foo\Bar\Bar');
        $this->assertEquals('Bar', $type->short());
    }

    /**
     * @testdox It returns the "short" name for a primitive.
     */
    public function testShortPrimitive(): void
    {
        $type = Type::fromString('string');
        $this->assertEquals('string', $type->short());
    }

    /**
     * @testdox It has descriptors to say if it is a class or primitive.
     */
    public function testReturnsIfClass(): void
    {
        $type = Type::fromString('Foo\Bar');
        $this->assertTrue($type->isClass());
        $this->assertFalse($type->isPrimitive());

        $type = Type::fromString('string');
        $this->assertFalse($type->isClass());
        $this->assertTrue($type->isPrimitive());

        $type = Type::collection('MyCollection', 'string');
        $this->assertTrue($type->isClass());
        $this->assertFalse($type->isPrimitive());
    }

    /**
     * @dataProvider provideValues
     */
    public function testItCanBeCreatedFromAValue($value, Type $expectedType): void
    {
        $type = Type::fromValue($value);
        $this->assertEquals($expectedType, $type);
    }

    public function provideValues()
    {
        yield [
            'string',
            Type::string(),
        ];

        yield [
            11,
            Type::int(),
        ];

        yield [
            11.2,
            Type::float(),
        ];

        yield [
            [],
            Type::array(),
        ];

        yield [
            true,
            Type::bool(),
        ];

        yield [
            false,
            Type::bool(),
        ];

        yield [
            null,
            Type::null(),
        ];

        yield [
            new stdClass(),
            Type::class(ClassName::fromString('stdClass')),
        ];

        yield 'resource' => [
            \fopen(__FILE__, 'r'),
            Type::resource(),
        ];

        yield 'callable' => [
            function (): void {
            },
            Type::callable(),
        ];
    }

    public function testItIsImmutableClassName(): void
    {
        $class = ClassName::fromString('Hello\\Goodbye');
        $type1 = Type::class($class);
        $type2 = $type1->withArrayType(Type::fromString('string'));

        $this->assertNotSame($type1, $type2);
        $this->assertNotSame($type1->className(), $type2->className());
    }

    public function testItIsImmutableIterableType(): void
    {
        $type1 = Type::array(Type::fromString('Foobar'));
        $type2 = $type1->withClassName(ClassName::fromString('ClassOne'));

        $this->assertNotSame($type1, $type2);
        $this->assertNotSame($type1->arrayType(), $type2->arrayType());
    }

    public function testIsClassShouldNotReturnTrueForObjectType(): void
    {
        $type1 = Type::fromString('object');
        $this->assertFalse($type1->isClass());
        $this->assertEquals('object', $type1->__toString());
    }

    public function testHasMethodToIndicateIfItIsNullable(): void
    {
        $type1 = Type::fromString('string');
        $this->assertFalse($type1->isNullable());
        $type1 = Type::fromString('?string');
        $this->assertTrue($type1->isNullable());
    }
}

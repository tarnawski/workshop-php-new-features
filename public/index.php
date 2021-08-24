<?php

# Named arguments
$text = htmlspecialchars('/.;<>,$%', double_encode: false);
echo $text;

#Constructor property promotion
class Email
{
    public function __construct(public string $value = 'anonymous@domain.com') 
    {
    }
    
    public function toString(): string 
    {
        return $this->value;
    }
}
$email = new Email();
echo $email->toString();

$email = new Email('admin@domain.com');
echo $email->toString();

#Union types
class Code
{
    public function __construct(private int|string $value) 
    {
    }

    public function toString(): string
    {
        return (string) $this->value;
    }
}

$email = new Code(200);
echo $email->toString();

$email = new Code('200');
echo $email->toString();

# Match expression
$value = match ('200') {
    '200' => 'HTTP OK',
    '500' => 'INTERNAL ERROR'
};
echo $value;

#Nullsafe operator
class Status
{
    public function __construct(private Code|null $code = null)
    {
    }

    public function getCode(): Code|null
    {
        return $this->code;
    }
}

$status = new Status();
echo $status->getCode()?->toString();

$status = new Status(new Code(200));
echo $status->getCode()?->toString();

#Adding or removing types to a Union
class A
{
    public function foo(string|int $foo): void {}
}
class B extends A
{
    public function foo(string|int|float $foo): void {}
}

$b = new B();

#New Functions
echo str_contains('Foobar', 'Foo');
echo str_starts_with('PHP 8.0', 'PHP');
echo str_ends_with('PHP 8.0', '8.0');

#Stringable interface
class Name implements Stringable
{
    public function __construct(private int|string $value)
    {
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}

#New mixed pseudo type
class Serializer
{
    public function serialize(mixed $variable): string
    {
        return serialize($variable);
    }
}

# Throw in expressions
$status = 200;
$value = 200 === $status
    ? 'OK'
    : throw new \InvalidArgumentException('Status is incorrect');

#Catch exceptions only by type
try {
    
} catch(TypeError) {
    // No $exception object
}

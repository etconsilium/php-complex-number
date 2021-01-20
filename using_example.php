<?php

/*
 * To test Math_Complex and Math_ComplexOp
 * $Id: using_complexop.php 155922 2004-04-13 20:43:43Z jmcastagnetto $
 */

require_once 'vendor/autoload.php';

use Math\Complex;
use Math\Complex\Operation;

$a = complex(0.3, 0.5);
$b = complex(1.0, -M_PI_2);
$im = -1.2;
echo "a = " . $a->toString() . PHP_EOL;
echo "b = " . $b->toString() . PHP_EOL;
echo "im = {$im}i" . PHP_EOL;
$z = Complex::createFromPolar(0.022, -0.223);
echo "from polar, z = " . $z->toString() . PHP_EOL;
$z = Operation::sqrt($a);
echo "sqrt(a) = " . $z->toString() . PHP_EOL;
$z = Operation::sqrtReal(-2.3);
echo "sqrtReal(a) = " . $z->toString() . PHP_EOL;
$z = Operation::exp($a);
echo "exp(a) = " . $z->toString() . PHP_EOL;
$z = Operation::log($a);
echo "log(a) = " . $z->toString() . PHP_EOL;
$z = Operation::log10($a);
echo "log10(a) = " . $z->toString() . PHP_EOL;
$z = Operation::conjugate($a);
echo "conjugate(a) = " . $z->toString() . PHP_EOL;
$z = Operation::negative($a);
echo "negative(a) = " . $z->toString() . PHP_EOL;
$z = Operation::inverse($a);
echo "inverse(a) = " . $z->toString() . PHP_EOL;
$z = Operation::sin($a);
echo "sin(a) = " . $z->toString() . PHP_EOL;
$z = Operation::cos($a);
echo "cos(a) = " . $z->toString() . PHP_EOL;
$z = Operation::tan($a);
echo "tan(a) = " . $z->toString() . PHP_EOL;
$z = Operation::sec($a);
echo "sec(a) = " . $z->toString() . PHP_EOL;
$z = Operation::csc($a);
echo "csc(a) = " . $z->toString() . PHP_EOL;
$z = Operation::cot($a);
echo "cot(a) = " . $z->toString() . PHP_EOL;
$z = Operation::asin($a);
echo "asin(a) = " . $z->toString() . PHP_EOL;
$z = Operation::asinAlt($a);
echo "asinAlt(a) = " . $z->toString() . PHP_EOL;
$z = Operation::asinReal(-0.22);
echo "asinReal(a) = " . $z->toString() . PHP_EOL;
$z = Operation::acos($a);
echo "acos(a) = " . $z->toString() . PHP_EOL;
$z = Operation::atan($a);
echo "atan(a) = " . $z->toString() . PHP_EOL;
$z = Operation::asec($a);
echo "asec(a) = " . $z->toString() . PHP_EOL;
$z = Operation::acsc($a);
echo "acsc(a) = " . $z->toString() . PHP_EOL;
$z = Operation::acot($a);
echo "acot(a) = " . $z->toString() . PHP_EOL;
$z = Operation::sinh($a);
echo "sinh(a) = " . $z->toString() . PHP_EOL;
$z = Operation::cosh($a);
echo "cosh(a) = " . $z->toString() . PHP_EOL;
$z = Operation::tanh($a);
echo "tanh(a) = " . $z->toString() . PHP_EOL;
$z = Operation::sech($a);
echo "sech(a) = " . $z->toString() . PHP_EOL;
$z = Operation::csch($a);
echo "csch(a) = " . $z->toString() . PHP_EOL;
$z = Operation::coth($a);
echo "coth(a) = " . $z->toString() . PHP_EOL;
$z = Operation::asinh($a);
echo "asinh(a) = " . $z->toString() . PHP_EOL;
$z = Operation::acosh($a);
echo "acosh(a) = " . $z->toString() . PHP_EOL;
$z = Operation::atanh($a);
echo "atanh(a) = " . $z->toString() . PHP_EOL;
$z = Operation::asech($a);
echo "asech(a) = " . $z->toString() . PHP_EOL;
$z = Operation::acsch($a);
echo "acsch(a) = " . $z->toString() . PHP_EOL;
$z = Operation::acoth($a);
echo "acoth(a) = " . $z->toString() . PHP_EOL;
if (!Operation::areEqual($a, $b)) {
    echo "a != b\n";
}
$z = Operation::add($a, $b);
echo "add(a, b) = " . $z->toString() . PHP_EOL;
$z = Operation::sub($a, $b);
echo "sub(a, b) = a - b = " . $z->toString() . PHP_EOL;
$t = Operation::sub($b, $a);
echo "b - a: " . $t->toString() . PHP_EOL;
$t = Operation::sub($b, Operation::conjugate($a));
echo "b - a': " . $t->toString() . PHP_EOL;
$v = Operation::conjugate($b);
$t = Operation::sub($v, $a);
echo "b' - a: " . $t->toString() . PHP_EOL;
$v = Operation::conjugate($b);
$t = Operation::sub($v, Operation::conjugate($a));
echo "b' - a': " . $t->toString() . PHP_EOL;
$z = Operation::mult($a, $b);
echo "mult(a, b) = " . $z->toString() . PHP_EOL;
$z = Operation::div($a, $b);
echo "div(a, b) = " . $z->toString() . PHP_EOL;
$z = Operation::pow($a, $b);
echo "pow(a, b) = " . $z->toString() . PHP_EOL;
$z = Operation::logBase($a, $b);
echo "logBase(a, b) = " . $z->toString() . PHP_EOL;
$z = Operation::multReal($a, M_PI);
echo "multReal(a, M_PI) = " . $z->toString() . PHP_EOL;
$z = Operation::multIm($a, $im);
echo "multIm(a, i) = " . $z->toString() . PHP_EOL;
$z = Operation::powReal($a, M_E);
echo "powReal(a, M_E) = " . $z->toString() . PHP_EOL;


<?php

namespace Math\Complex;

use Math\Complex;

/**
 * Returns the square of the magnitude of the number
 *
 * @param Math\Complex $param
 * @return float
 * @access public
 */
function abs2(Complex $param) {
    return ($param->real * $param->real + $param->imaginary * $param->imaginary);
}

/**
 * Returns the magnitude (also referred as norm) of the number
 *
 * @param Math\Complex $param
 * @return float
 * @access public
 */
function abs(Complex $param) {
    return \sqrt(abs2($param));
}

/**
 * Returns the norm of the number
 * Alias of Math\Complex\abs()
 *
 * @param Math\Complex $param
 * @return float
 * @access public
 */
function norm(Complex $param) {
    return \abs($param);
}

/**
 * Returns the argument of the complex number
 *
 * @param Math\Complex $param
 * @return float A floating point number on success, a raise Exception otherwise
 * @throws InvalidArgumentException
 * @access public
 */
function arg(Complex $param) {
    $arg = \atan2($param->imaginary, $param->real);
    if (\M_PI < $arg || $arg < - \M_PI) {
        throw new \InvalidArgumentException('Argument has an impossible value in Math\Complex::arg()');
    }
    return $arg;
}

/**
 * Returns the angle (argument) associated with the complex number
 * Alias of Math\Complex\arg()
 *
 * @param Math\Complex $param
 * @return float
 * @access public
 */
function angle(Complex $param) {
    return arg($param);
}

/**
 * Calculates the complex square root of a complex number: z = sqrt(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function sqrt(Complex $c1) {
    $x = \abs($c1->getReal());
    $y = \abs($c1->getIm());
    if ($x == 0 && $y == 0) {
        $r = $i = 0.0;
    } else {
        if ($x >= $y) {
            $t = $y / $x;
            $w = \sqrt($x) * \sqrt(0.5 * (1.0 + \sqrt(1.0 + $t * $t)));
        } else {
            $t = $x / $y;
            $w = \sqrt($y) * \sqrt(0.5 * ($t + \sqrt(1.0 + $t * $t)));
        }

        if ($c1->getReal() >= 0.0) {
            $r = $w;
            $i = $c1->getIm() / (2.0 * $w);
        } else {
            $i = ($c1->getIm() >= 0) ? $w : - $w;   //  [1,-1][$c1->getIm() >= 0]
            $r = $c1->getIm() / (2.0 * $i);
        }
    }
    return complex($r, $i);
}

/**
 * Calculates the complex square root of a real number: z = sqrt(realnumber)
 *
 * @param float $realnum A float number
 * @return \Math\Complex
 * @access public
 */
function sqrtReal($realnum) {
    if ($realnum >= 0) {
        $r = \sqrt($realnum);
        $i = 0.0;
    } else {
        $r = 0.0;
        $i = \sqrt(- $realnum);
    }
    return complex($r, $i);
}

/**
 * Calculates the exponential of a complex number: z = exp(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function exp(Complex $c1) {
    $rho = \exp($c1->getReal());
    $theta = $c1->getIm();

    $r = $rho * \cos($theta);
    $i = $rho * \sin($theta);
    return complex($r, $i);
}

/**
 * Calculates the logarithm (base 2) of a complex number: z = log(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function log(Complex $c1) {
    $r = \log(abs($c1));
    $i = arg($c1);
    return complex($r, $i);
}

/**
 * Calculates the logarithm (base 10) of a complex number: z = log10(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function log10(Complex $c1) {
    $log = log($c1);
    return multReal($log, 1 / \log(10));
}

/**
 * Calculates the conjugate of a complex number: z = conj(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function conjugate(Complex $c1) {
    return complex($c1->getReal(), - $c1->getIm());
}

/**
 * Calculates the negative of a complex number: z = -c1
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function negative(Complex $c1) {
    return complex(- $c1->getReal(), - $c1->getIm());
}

/**
 * Calculates the inverse of a complex number: z = 1/c1
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @throws \DivisionByZeroError
 * @access public
 */
function inverse(Complex $c1) {
    $abs = abs($c1);
    if ($abs == 0) {
        throw new \DivisionByZeroError('Math\\Complex object\'s normal is zero while calculating Math\\Complex::inverse()');
    }
    $temp = 1 / abs($c1);
    $r = $c1->getReal() * $temp * $temp;    //  mysterious optimization!
    $i = - $c1->getIm() * $temp * $temp;
    return complex($r, $i);
}

// Trigonometric methods

/**
 * Calculates the sine of a complex number: z = sin(c1)
 *
 * @static
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function sin(Complex $c1) {
    $a = $c1->getReal();
    $b = $c1->getIm();
    $r = \sin($a) * \cosh($b);
    $i = \cos($a) * \sinh($b);
    return complex($r, $i);
}

/**
 * Calculates the cosine of a complex number: z = cos(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function cos(Complex $c1) {
    $a = $c1->getReal();
    $b = $c1->getIm();
    $r = \cos($a) * \cosh($b);
    $i = \sin($a) * \sinh($b);
    return complex($r, $i);
}

/**
 * Calculates the tangent of a complex number: z = tan(c1)
 *
 * @deprecated because hiperbolic function is required
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @throws \DivisionByZeroError
 * @access public
 */
function tan(Complex $c1) {
    $a = $c1->getReal();
    $b = $c1->getIm();
    $den = 1 + \pow(\tan($a), 2) * \pow(\tanh($b), 2);
    if ($den == 0.0) {
        throw new \DivisionByZeroError('Division by zero while calculating Math\Complex::tan()');
    }
    $r = \pow((1 / \cosh($b)), 2) * \tan($a) / $den;
    $i = \pow((1 / \cos($a)), 2) * \tanh($b) / $den;
//    $r = \pow(Math_TrigOp::sech($b), 2) * \tan($a) / $den;
//    $i = \pow(Math_TrigOp::sec($a), 2) * \tanh($b) / $den;
    return complex($r, $i);
}

/**
 * Calculates the secant of a complex number: z = sec(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function sec(Complex $c1) {
    return inverse(cos($c1));
}

/**
 * Calculates the cosecant of a complex number: z = csc(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex
 * @access public
 */
function csc(Complex $c1) {
    return inverse(sin($c1));
}

/**
 * Calculates the cotangent of a complex number: z = cot(c1)
 *
 * @param Math\Complex $c1
 * @return sin($c1)
 * @access public
 */
function cot(Complex $c1) {
    return inverse(tan($c1));
}

// Inverse trigonometric methods

/**
 * Calculates the inverse sine of a complex number: z = asin(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function asin(Complex $c1) {
    $t = mult($c1, $c1);
    $v = sub(complex(1, 0), $t);
    $t = sqrt($v);
    $v = complex($t->getReal() - $c1->getIm(), $t->getIm() + $c1->getReal());
    $z = log($v);
    return complex($z->getIm(), - $z->getReal());
}

// alternative method

/**
 * Calculates the inverse sine of a complex number: z = asinAlt(c1)
 * Uses an alternative algorithm
 *
 * @static
 * @param Math\Complex $c1
 * @return Math_Complex|PEAR_Error A valid Math_Complex number on success, PEAR_Error otherwise
 * @access public
 */
function asinAlt(Complex $c1) {
    $r = $c1->getReal();
    $i = $c1->getIm();
    if ($i == 0) {
        return asinReal($r);
    } else {
        $x = \abs($r);
        $y = \abs($i);
        $r = \hypot($x + 1, $y);
        $s = \hypot($x - 1, $y);
        $a = ($r + $s) / 2;
        $b = $x / $a;
        $y2 = $y * $y;
        $ac = 1.5;
        $bc = 0.6417; // crossover values   //  WTF

        if ($b <= $bc) {
            $real = \asin($b);
        } else {
            if ($x <= 1) {
                $d = 0.5 * ($a + $x) * ($y2 / ($r + $x + 1) + ($s + (1 - $x)));
                $real = \atan2($x, sqrt($d));
            } else {
                $ax = $a + $x;
                $d = 0.5 * ($ax / ($r + $x + 1) + $ax / ($s + ($x - 1)));
                $real = \atan2($x, $y * sqrt($d));
            }
        }

        if ($a <= $ac) {
            if ($x < 1) {
                $m = 0.5 * ($y2 / ($r + ($x + 1)) + $y2 / ($s + (1 - $x)));
            } else {
                $m = 0.5 * ($y2 / ($r + ($x + 1)) + ($s + ($x - 1)));
            }
            $im = \log1p($m + \sqrt($m * ($a + 1)));
        } else {
            $im = \log($a + \sqrt($a * $a - 1));
        }
        $real = ($r >= 0) ? $real : -1 * $real;
        $im = ($i >= 0) ? $im : -1 * $im;
        return complex($real, $im);
    }
}

/**
 * Calculates the complex inverse sine of a real number: z = asinReal(r):
 * 
 * @param float $r
 * @return \Math\Complex 
 * @access public
 */
function asinReal($r) {
    $r = floatval($r);
    if (\abs($r) <= 1.0) {
        return \complex(\asin($r), 0.0);
    } else {
        if ($r < 0.0) {
            return \complex(- \M_PI_2, \acosh($r));
        } else {
            return \complex(\M_PI_2, - \acosh($r));
        }
    }
}

/**
 * Calculates the inverse cosine of a complex number: z = acos(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function acos(Complex $c1) {
    $t = mult($c1, $c1);
    $v = sub(complex(1, 0), $t);
    $t = sqrt($v);
    $v = complex($c1->getReal() - $t->getIm(), $c1->getIm() + $t->getReal());
    $z = log($v);
    return complex($z->getIm(), - $z->getReal());
}

/**
 * Calculates the inverse tangent of a complex number: z = atan(c1):
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function atan(Complex $c1) {
    $u = complex(-1 * $c1->getIm(), $c1->getReal());
    $t = complex(1, 0);
    $d1 = sub($t, $u);
    $d2 = add($t, $u);
    $u = div($d1, $d2);
    return multIm(log($u), 0.5);
}

/**
 * Calculates the inverse secant of a complex number: z = asec(c1)
 *
 * @param Math\Complex $c1
 * @return Math_Complex|PEAR_Error A valid Math_Complex number on success, PEAR_Error otherwise
 * @access public
 */
function asec(Complex $c1) {
    return acos(inverse($c1));
}

/**
 * Calculates the inverse cosecant of a complex number: z = acsc(c1)
 *
 * @param Math\Complex $c1
 * @return Math_Complex|PEAR_Error A valid Math_Complex number on success, PEAR_Error otherwise
 * @access public
 */
function acsc($c1) {
    return asin(inverse($c1));
}

/**
 * Calculates the inverse cotangent of a complex number: z = acot(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function acot(Complex $c1) {
    return atan(inverse($c1));
}

// Hyperbolic methods

/**
 * Calculates the hyperbolic sine of a complex number: z = sinh(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function sinh(Complex $c1) {
    $r = $c1->getReal();
    $i = $c1->getIm();
    return \complex(\sinh($r) * \cos($i), \cosh($r) * \sin($i));
}

/**
 * Calculates the hyperbolic cosine of a complex number: z = cosh(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function cosh(Complex $c1) {
    $r = $c1->getReal();
    $i = $c1->getIm();
    return \complex(\cosh($r) * \cos($i), \sinh($r) * \sin($i));
}

/**
 * Calculates the hyperbolic tangent of a complex number: z = tanh(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function tanh(Complex $c1) {
    $r = $c1->getReal();
    $i = $c1->getIm();
    $d = \cos($i) * \cos($i) + \sinh($r) * \sinh($r);
    return \complex(\sinh($r) * \cosh($r) / $d, 0.5 * \sin(2 * $i) / $d);
}

/**
 * Calculates the hyperbolic secant of a complex number: z = sech(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function sech(Complex $c1) {
    return inverse(cosh($c1));
}

/**
 * Calculates the hyperbolic cosecant of a complex number: z = csch(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function csch(Complex $c1) {
    return inverse(sinh($c1));
}

/**
 * Calculates the hyperbolic cotangent of a complex number: z = coth(c1)
 *
 * @param Math\Complex $c1
 * @return Math_Complex|PEAR_Error A valid Math_Complex number on success, PEAR_Error otherwise
 * @access public
 */
function coth($c1) {
    return inverse(tanh($c1));
}

// Inverse hyperbolic methods

/**
 * Calculates the inverse hyperbolic sine of a complex number: z = asinh(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function asinh(Complex $c1) {
    return multIm(asin(multIm($c1, 1.0)), -1.0);

//    if (!Math_ComplexOp::isComplex($c1)) {
//        return PEAR::raiseError('argument is not a PEAR::Math_Complex object');
//    }
//    $z = Math_ComplexOp::multIm($c1, 1.0);
//    $z = Math_ComplexOp::asin($z);
//    if (PEAR::isError($z)) {
//        return $z;
//    } else {
//        return Math_ComplexOp::multIm($z, -1.0);
//    }
}

/**
 * Calculates the inverse hyperbolic cosine of a complex number: z = acosh(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function acosh(Complex $c1) {
    $z = acos($c1);
    return multIm($z, [-1, 1][($z->getIm() > 0)]);
//    return Math_ComplexOp::multIm($z, (($z->getIm() > 0) ? 1.0 : -1.0));
}

/**
 * Calculates the inverse hyperbolic tangent of a complex number: z = atanh(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function atanh(Complex $c1) {
    if ($c1->getIm() == 0.0) {
        $r = $c1->getReal();
        if ($r > -1.0 && $r < 1.0) {
            return \complex(\atanh($r), 0.0);
        } else {
            return \complex(\atanh(1 / $r), (($a < 0) ? \M_PI_2 : -1 * \M_PI_2));
        }
    } else {
        $z = atan(multIm($c1, 1.0));
        return multIm($z, -1.0);
    }
}

/**
 * Calculates the inverse hyperbolic secant of a complex number: z = asech(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function asech(Complex $c1) {
    return acosh(inverse($c1));
}

/**
 * Calculates the inverse hyperbolic cosecant of a complex number: z = acsch(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function acsch($c1) {
    return asinh(inverse($c1));
}

/**
 * Calculates the inverse hyperbolic cotangent of a complex number: z = acoth(c1)
 *
 * @param Math\Complex $c1
 * @return Math\Complex 
 * @access public
 */
function acoth(Complex $c1) {
    return atanh(inverse($c1));
}

// functions below need 2 valid \Math\Complex objects as parameters

/**
 * Determines if is c1 == c2:
 *
 * @param Math\Complex $c1
 * @param Math\Complex $c2
 * @return boolean
 * @access public
 */
function areEqual(Complex $c1, Complex $c2) {
    return ( $c1->getReal() == $c2->getReal() ) && ( $c1->getIm() == $c2->getIm() );
}

/**
 * Returns the sum of two complex numbers: z = c1 + c2
 *
 * @param Math\Complex $c1
 * @param Math\Complex $c2
 * @return \Math\Complex
 * @access public
 */
function add(Complex $c1, Complex $c2) {
    return complex($c1->getReal() + $c2->getReal(), $c1->getIm() + $c2->getIm());
}

/**
 * Returns the difference of two complex numbers: z = c1 - c2
 *
 * @param Math\Complex $c1
 * @param Math\Complex $c2
 * @return Math\Complex 
 * @access public
 */
function sub(Complex $c1, Complex $c2) {
    return add($c1, negative($c2));
}

/**
 * Returns the product of two complex numbers: z = c1 * c2
 *
 * @param Math\Complex $c1
 * @param Math\Complex $c2
 * @return \Math\Complex
 * @access public
 */
function mult(Complex $c1, Complex $c2) {
    $r = ($c1->getReal() * $c2->getReal()) - ($c1->getIm() * $c2->getIm());
    $i = ($c1->getReal() * $c2->getIm()) + ($c2->getReal() * $c1->getIm());
    return complex($r, $i);
}

/**
 * Returns the division of two complex numbers: z = c1 * c2
 *
 * @param Math\Complex $c1
 * @param Math\Complex $c2
 * @return \Math\Complex
 * @access public
 */
function div(Complex $c1, Complex $c2) {
    $a = $c1->getReal();
    $b = $c1->getIm();
    $c = $c2->getReal();
    $d = $c2->getIm();
    $div = $c * $c + $d * $d;
    if ($div == 0.0) {
        throw new \DivisionByZeroError('Division by zero in Math\Complex::div()');
    } else {
        $r = ($a * $c + $b * $d) / $div;
        $i = ($b * $c - $a * $d) / $div;
        return complex($r, $i);
    }
}

/**
 * Returns the complex power of two complex numbers: z = c1^c2
 *
 * @param Math\Complex $c1
 * @param Math\Complex $c2
 * @return \Math\Complex
 * @access public
 */
function pow(Complex $c1, Complex $c2) {
    $ar = $c1->getReal();
    $ai = $c1->getIm();
    $br = $c2->getReal();
    $bi = $c2->getIm();

    if ($ar == 0.0 && $ai == 0.0) {
        $r = $i = 0.0;
    } else {
        $logr = \log(abs($c1));
        $theta = arg($c1);
        $rho = \exp($logr * $br - $bi * $theta);
        $beta = $theta * $br + $bi * $logr;
        $r = $rho * \cos($beta);
        $i = $rho * \sin($beta);
    }
    return complex($r, $i);
}

/**
 * Returns the logarithm of base c2 of the complex number c1
 *
 * @param Math\Complex $c1
 * @param Math\Complex $c2
 * @return \Math\Complex
 * @access public
 */
function logBase(Complex $c1, Complex $c2) {
    return div(log($c1), log($c2));
}

// these functions need a complex number and a real number

/**
 * Multiplies a complex number by a real number: z = realnumber * c1
 *
 * @param Math\Complex $c1
 * @param float $real
 * @return \Math\Complex
 * @access public
 */
function multReal(Complex $c1, $real) {
    $r = $c1->getReal() * $real;
    $i = $c1->getIm() * $real;
    return complex($r, $i);
}

/**
 * Returns the product of a complex number and an imaginary number
 * if: x = b + c*i, y = a*i; then: z = x * y = multIm(x, a)
 *
 * @param Math\Complex $c1
 * @param float $im
 * @return \Math\Complex
 * @access public
 */
function multIm(Complex $c1, $im) {
    $r = - $c1->getIm() * $im;
    $i = $c1->getReal() * $im;
    return complex($r, $i);
}

/**
 * Returns the exponentiation of a complex numbers to a real power: z = c1^(real)
 *
 * @param Math\Complex $c1
 * @param float $real
 * @return \Math\Complex
 * @access public
 */
function powReal(Complex $c1, $real) {
    $ar = $c1->getReal();
    $ai = $c1->getIm();
    if ($ar == 0 && $ai == 0) {
        $r = $i = 0.0;
    } else {
        $logr = \log(abs($c1));
        $theta = arg($c1);
        $rho = \exp($logr * $real);
        $beta = $theta * $real;
        $r = $rho * \cos($beta);
        $i = $rho * \sin($beta);
    }
    return complex($r, $i);
}

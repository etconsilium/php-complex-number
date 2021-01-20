<?php

/**
 * Package with classes to represent and manipulate complex number. Contain
 * definitions for basic arithmetic functions, as well as trigonometric,
 * inverse trigonometric, hyperbolic, inverse hyperbolic, exponential and
 * logarithms of complex numbers.
 * @package Math\Complex
 */

namespace Math;

/**
 * Complex: class to represent an manipulate complex numbers (z = a + b*i)
 *
 * Originally this class was part of PEAR::Math_Complex by "Jesus M. Castagnetto <jmcastagnetto@php.net>"
 * https://pear.php.net/package/Math_Complex
 *
 * @author  <etconsilium@github.com>
 * @version 1.9
 * @access  public
 */
class Complex extends \ArrayObject {

    const BaseArray = array('real' => null, 'imaginary' => null);
    const StringPattern = '%.4g%+-.4gi';

//    const StringPattern = '%-.3f% + -.3fi';

    /**
     * Constructor for Math/Complex
     * 
     * @param Array [float $real, float $imaginary]
     *  Real part of the number, Imaginary part of the number
     * @return object Math\Complex
     * @access public
     */
    public function __construct($input = self::BaseArray, int $flags = \ArrayObject::ARRAY_AS_PROPS) {
        $input = \array_map('floatval', \array_intersect_key(\array_merge(self::BaseArray, $input), self::BaseArray));
        parent::__construct($input, $flags);
    }

    /**
     * Static fabrique method
     * 
     * @param float|array $real Real part of the number OR array OR object
     * @param float $im Imaginary part of the number
     * @return Math\Complex
     */
    public static function new($real, $im = null) {
        if ($real instanceof self) {
            return $real;
        }
        if (is_object($real)) {
            $_ = (array) $real;
        } else {
            $_ = func_get_args();
        }
        //  @ sic
        @ $real = !is_array($_ = $_[0]) ? $real : ($_['real'] ?: ($_['r'] ?: ($_[0] ?: null)));
        //  @ sic
        @ $im = $_['imaginary'] ?: ($_['im'] ?: ($_['i'] ?: ($_[1] ?: $im)));
        return new self(\array_combine(array_keys(self::BaseArray), [$real, $im]));
    }

    /**
     * Alias of Math\Complex::new($r, $i)
     * 
     * @return Math\Complex
     */
    public static function createFromFloat() {
        return \call_user_func_array([__CLASS__, 'new'], \func_get_args());
    }

    /**
     * Converts a polar complex z = r*exp(theta*i) to z = a + b*i
     *
     * @static
     * @param float $r  radius
     * @param float $theta angle, Radian(?)
     * @return Math\Complex
     */
    public static function createFromPolar($r, $theta) {
        $r = floatval($r);
        $theta = floatval($theta);
        $a = $r * cos($theta);
        $b = $r * sin($theta);
        return \call_user_func_array([__CLASS__, 'new'], [$r * cos(floatval($theta)), $r * sin(floatval($theta))]);
    }

    /**
     * @deprecated NOT YET IMPLEMENTED
     * @todo 
     */
    public static function createFromString($string = null) {
        return \call_user_func_array([__CLASS__, 'new']);
    }

    /**
     * 
     * @return string
     */
    public function __toString() {
        return $this->asString('%.2G%+.2Gj');
    }

    /**
     * Simple string representation of the complex number
     *
     * @param string $format like for sprintf()
     * @return string
     * @access public
     */
    public function asString($format = self::StringPattern) {
        return sprintf($format, $this->getReal(), $this->getIm());
    }

    /**
     * Alias asString() method for orthodox
     *
     * @deprecated forever
     */
    public function toString($format = self::StringPattern) {
        return $this->asString($format);
    }

    /**
     * Simple array representation of the complex number
     *
     * @param bool $withIndexes = true returns array(0=>$real,1=>$imaginary, "real"=>$real, "imaginary"=>$imaginary)
     * @return array
     * @access public
     */
    public function asArray(bool $withIndexes = true) {
//        return $this;
//        return array_merge([$this->getReal(), $this->getImaginary()], (array) $this);
        $_ = $this->getArrayCopy();
        return $withIndexes ? $_ + array_values($_) : $_;
    }

    /**
     * Simple object representation of the complex number
     *
     * @return stdClass
     * @access public
     */
    public function asObject() {
        return (object) $this->getArrayCopy();
    }

    /**
     * Returns the real part of the complex number
     *
     * @return float
     * @access public
     */
    public function getReal() {
        //  work with flag \ArrayObject::ARRAY_AS_PROPS 
        //  return $this->real;
        return $this['real'];
    }

    /**
     * Returns the imaginary part of the complex number
     * 
     * @return float
     * @access public
     */
    public function getImaginary() {
        return $this['imaginary'];
    }

    /**
     * Alias of getImaginary
     * 
     * @return float
     * @access public
     */
    public function getIm() {
        return $this->getImaginary();
    }

}

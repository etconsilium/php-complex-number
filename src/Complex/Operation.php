<?php

/**
 * Package with classes to represent and manipulate complex number. Contain
 * definitions for basic arithmetic functions, as well as trigonometric,
 * inverse trigonometric, hyperbolic, inverse hyperbolic, exponential and
 * logarithms of complex numbers.
 *
 * @package Math\Complex
 */

namespace Math\Complex;

use Math;
use Math\Complex;

/**
 * Math\Complex\Operations: class to operate on Math\Complex objects
 *
 * Originally this class was part of class PEAR::Math_ComplexOp by "Jesus M. Castagnetto <jmcastagnetto@php.net>"
 * https://pear.php.net/package/Math_Complex
 *
 * @author  <etconsilium@github.com>
 * @version 1.9
 * @access  public
 */
class Operation extends \ArrayObject {

    /**
     * 
     * @param Complex $param Arguments list
     */
    public function __construct(\Math\Complex ...$param) {
        parent::__construct($param, \ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Short alias fetch() method
     * 
     * @return type
     */
    public function __invoke() {
        return $this->fetch();
    }

    /**
     * 
     * @param string $name @see \Math\Complex\Utils.php
     * @param Complex $arguments array
     * @return \Math\Complex\Operation
     * @throws \RuntimeException
     */
    public function __call(string $name, array $arguments) {
        try {
            $operation = new \ReflectionFunction(implode('\\', [__NAMESPACE__, $name]));
            $parameters = $operation->getParameters();
            $args = $arguments;
            $arr = $this->getArrayCopy();
            //  заменить на слайс или другое приличное
            for ($n = 0; $n < count($parameters) - count($arguments); $n++) {
                array_push($args, array_shift($arr));
            }
            $result = $operation->invokeArgs($args);
        } catch (\Exception $exc) {
            throw new \RuntimeException("function '{$name}' not found or invalid function name or some unexplained error ¯\_(ツ)_/¯");
//            throw new DomainException($exc->getTraceAsString());
        }
        $arr = array_merge([Complex::new($result)], $arr);
        $this->exchangeArray($arr);

        return $this;
    }

    /**
     * Just calling the function by name
     * 
     * @param string $name \Math\Complex\Operation
     * @param array $arguments \Math\Complex or stdClass
     * @return float|mixed
     */
    public static function __callStatic(string $name, array $arguments) {
        $operation = implode('\\', [__NAMESPACE__, $name]);
        if (!is_callable($operation)) {
            throw new \ErrorException("function '{$name}' not found or invalid function name");
        }
        return call_user_func_array($operation, $arguments);
    }

    /**
     * Fetch one parameter of operation from head of the heap
     * 
     * @param bool $asArray
     * @return \Math\Complex
     */
    public function fetch($asArray = false) {
        $a = $this->getArrayCopy();
        $r = array_shift($a);
        $this->exchangeArray($a);
        return $asArray ? $r->asArray() : $r;
    }

    /**
     * Fetch all operation parameters
     * 
     * @param bool $asArray
     * @return array of \Math\Complex
     */
    public function fetchAll($asArray = false) {
        $a = $this->getArrayCopy();
        $this->exchangeArray([]);
        return $asArray ? array_map('asArray', $a) : $a;
    }

}

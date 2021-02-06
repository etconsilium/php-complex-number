# Complex numbers
##### Classes that define complex numbers and their operations, based on PEAR::Math_Complex

### How to use
 #### Imperative Procedural Approach 
```php
use Math\Complex;
use Math\Complex\Operation;

$a = complex(0.3, 0.5);
$b = complex(1.0, -M_PI_2);

echo "a = " . $a->toString() . PHP_EOL;
echo "b = " . $b->toString() . PHP_EOL;
$z = Operation::sqrt($a);
echo "sqrt(a) = " . $z->toString() . PHP_EOL;
$z = log10($b);
echo "log10(a) = " . $z->toString() . PHP_EOL;

$z = add($a, $b);
echo "add(a, b) = " . $z->toString() . PHP_EOL;
$z = Operation::div($a, $b);
echo "div(a, b) = " . $z->toString() . PHP_EOL;
```
@see also [using_example.php](./using_example.php)


 #### Object Oriented Approach
```php
use Math\Complex;
use Math\Complex\Operation;

$a = Complex::new(0.3, 0.5);    //  factory method contains syntactic sugar 
$b = new Complex(["real" => 1, "imaginary" => -M_PI_2]); //  constructor does not 

$op = new Operation($a);        //  operands' FILO inside the class
//  Operation::add($a, $b);
$c = $op->add($b)->fetch();     //  first Complex element shift from heap's top and return
print $c->asString() . PHP_EOL;

print $op->mul($c,$a)() . PHP_EOL;  //  php double magic: __call alias fetch() & __toString

print $op->atan(complex(1,2))
	->mul(complex(3,4))         //  can be chained
	->add(complex(5,6))
	->abs();
```

#### Enjoy!

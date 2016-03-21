<?php
class Vehicle {
    public function printSound() {
       echo "vehicle";
    }
}

class Car extends Vehicle {
    public function printSound() {
echo "car";
    }
}

class Bike extends Vehicle {
    public function printSound() {
       echo "bike";
    }
}

$v=new Vehicle();
$c=new Car();
        Vehicle v = new Car();
        $Bike b = (Bike) v;
        
        v.printSound();
        b.printSound();
 


?>
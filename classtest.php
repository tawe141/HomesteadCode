<?php
    interface ShapeReqs {
        public function getArea();
        public function getPerimeter();
        public function whatShape();
    }
    class Shape {
        public final function whatShape() {
            echo "I am a " . static::class;
        }
    }
    class Square extends Shape implements ShapeReqs {
        protected $sides=4;
        protected $length;
        public function __construct($length) {
            $this->length=$length;
        }
        public function getArea() {
            return $length^2;
        }
        public function getPerimeter() {
            return $length * 3;
        }
    }

    class Triangle extends Shape implements ShapeReqs {
        protected $sides=3;
        protected $base;
        protected $length2;
        protected $length3;
        protected $height;
        public function __construct($base, $length2, $length3, $height=null) {
            $this->base = $base;
            $this->length2 = $length2;
            $this->length3 = $length3;
            if($height!==null) {
                $this->height = $height;
            }
        }
        public function getArea() {
            if($height==null) {
                return "No height defined!";
            }
            else {
                return 0.5*$base*$height;
            }
        }
        public function getPerimeter() {
            return $base + $length2 + $length3;
        }
    }
    class Circle extends Shape implements ShapeReqs {
        protected $radius;
        public function __construct($radius) {
            $this->radius = $radius;
        }
        public function getArea() {
            return $radius^2*M_PI;
        }
        public function getPerimeter() {
            return $radius*2*M_PI;
        }
    }
?>

<?php

/*
Create a class called products
    Have properties ‘title’, ‘description’, ‘price’, ‘weight’
    Create methods to get and set the title, description and price
    Create a method that converts lbs to oz, and sets the weight.

Create another Class that inherits / extends the product
    In the class set a method that sets the shipping price based upon the item’s weight. The cost of shipping is $0.7 per oz
    Have a method that calculates tax which is (10.25% of the price)
    Have a method that calculates the final price

    On the page, display a shopping total that has at least 3 products, show the description, and quantity you are ordering.
    Display the cost per item, total cost for items, total in taxes, and final price.
    Have one of the items convert the lb weight to oz
*/

class Product {

    public $title;
    public $description;
    public $price;
    public $weight;
    // public $ounces;

    public function __construct($title, $description, $price, $weight) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->weight = $weight;
        // $this->ounces = $this->lbs_to_oz();
    }

    public function get_title() {
        return $this->title;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_price() {
        return $this->price;
    }

    public function set_title($title) {
        return $this->title = $title;
    }
    public function set_description($description) {
        return $this->description = $description;
    }
    public function set_price($price) {
        return $this->price = $price;
    }

    public function lbs_to_oz() {
        return $this->weight * 16;
    }

};

class Shipping extends Product {

    public function shipping_price() {
        return $this->lbs_to_oz() * .70;
    }

    public function tax_price() {
        return $this->shipping_price() * .1025;
    }

    public function final_price() {
        return $this->tax_price() + $this->shipping_price() + $this->price;
    }
}

echo "<pre>";
print_r($product);
echo "</pre>";

$product1 = new Shipping('DDR Machine', 'Arcade cabinet', 1500, 500);
$product2 = new Shipping('Pupusa', 'Food', 2, .5);
$product3 = new Shipping('Water Bottle', 'Drinking device', 30, 2);

echo '<h1>Shopping Total</h1>';

echo '<p>1 - <b>$' . $product1->price . '</b> ' . $product1->title . ' - ' . $product1->description . '</p><p> Weight: ' . $product1->weight . 'lbs</p>';
echo '<p>1 - <b>$' . $product2->price . '</b> ' . $product2->title . ' - ' . $product2->description . '</p><p> Weight: ' . $product2->weight . 'lbs</p>';
echo '<p>1 - <b>$' . $product3->price . '</b> ' . $product3->title . ' - ' . $product3->description . '</p><p> Weight: ' . $product3->lbs_to_oz() . ' oz</p>';
echo '<p>Subtotal - <b>$' . ($product1->price + $product2->price + $product3->price) . '</b></p>';
echo '<p>Shipping - <b>$' . ($product1->shipping_price() + $product2->shipping_price() + $product3->shipping_price()) . '</b></p>';
echo '<p>Taxes - <b>$' . ($product1->tax_price() + $product2->tax_price() + $product3->tax_price()) . '</b></p>';
echo '<p>FINAL TOTAL - <b>$' . ($product1->final_price() + $product2->final_price() + $product3->final_price()) . '</b></p>';
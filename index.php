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

    public function __construct ( $products = array() ) {
        if ( isset( $products['title'] ) ) $this->set_title( $products['title'] );
        if ( isset( $products['description'] ) ) $this->set_description( $products['description'] );
        if ( isset( $products['price'] ) ) $this->set_price( $products['price'] );
        if ( isset( $products['weight'] ) ) $this->set_weight( $products['weight'] );
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

    public function set_weight($items) { // In this scenario, the only weight that can be entered into an array is lbs, so it will always convert to oz.
        return $this->weight = $items * 16;
    }
}

class CartItem extends Product {
    public $shipping_cost;
    public $tax;
    public $final_price;
    public $units = 1;

    public function __construct ( $products = array() ) {
        if ( isset( $products['title'] ) ) $this->set_title( $products['title'] );
        if ( isset( $products['description'] ) ) $this->set_description( $products['description'] );
        if ( isset( $products['price'] ) ) $this->set_price( $products['price'] );
        if ( isset( $products['weight'] ) ) $this->set_weight( $products['weight'] );
        if ( isset( $products['units'] ) ) $this->units = $products['units'];
        

        $this->set_shipping_cost(); // calling the function in the construct will run it when you create a new instance of the CartItem class.
        $this->set_tax();
        $this->set_final_price();
    }

    public function set_shipping_cost() {
        return $this->shipping_cost = ($this->weight * .7) * $this->units;
    }

    public function set_tax() {
        return $this->tax = ($this->price * .1025) * $this->units;
    }

    public function set_final_price() {
        return $this->final_price = $this->set_shipping_cost() + $this->set_tax() + ($this->price * $this->units);
    }
}

$products1 = [];

$products_parameters_1 = array(
    'title' => 'Seamoth',
    'description' => 'Underwater Vehicle',
    'price' => 1000,
    'weight' => 200,
    'units' => 3
);

$products1[] = new CartItem($products_parameters_1);

$products_parameters_2 = array(
    'title' => 'Prawn Suit',
    'description' => 'Underwater Vehicle',
    'price' => 2500,
    'weight' => 400,
    'units' => 2
);

$products1[] = new CartItem($products_parameters_2);

$products_parameters_3 = array(
    'title' => 'Cyclops',
    'description' => 'Submarine',
    'price' => 7500,
    'weight' => 1000,
    'units' => 1
);

$products1[] = new CartItem($products_parameters_3);

echo '<pre>';
print_r($products1);
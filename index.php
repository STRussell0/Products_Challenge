<?php

/*
    New changes:

    1. Must use an array in the construct function parameter

    public function __construct( $product = array() ) {

        if( isset( $product['title'] ) ) $this->set_title( $product['title'] );
        if( isset( $product['description'] ) ) $this->set_description( $product['description'] );
        if( isset( $product['price'] ) ) $this->set_price( $product['price'] );
        if( isset( $product['weight'] ) ) $this->set_weight( $product['weight'] );

    }

    2. Use a foreach loop to display the results:

    $grand_total = 0;
    $grand_total_tax = 0;
    $grand_total_shipping = 0;

    foreach ($products as $product) {
    
    echo "<p>Qty: " . $product->units . "</p>";
    echo "<p>Item Shipping: " . $product->shipping_cost . "</p>";
    echo "<p>Item Tax: " . $product->tax . "</p>";
    echo "<p>Item Total: " . $product->final_price . "</p>";

    $grand_total = $grand_total + $product->final_price;
    $grand_total_tax = $grand_total_tax + $product->tax;
    $grand_total_shipping = $grand_total_shipping + $product->shipping_cost;

}

    Bonus: Weight set function

    public function set_weight($array) {

        if( !isset( $array['weight'] ) ) return false;

        // Convert to Lbs to OZ
        if( $array['unit'] == 'lbs' ) {
            
            $array['weight'] = $array['weight'] * 16;

        } 

        return  $this->weight = array( 'weight' => $array['weight'], 'unit' => 'oz' );

    }

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

class Products {

    public $title;
    public $description;
    public $price;
    public $weight;

    public function __construct( $item = array() ) {
        if( isset( $item['title'] ) ) $this->set_title( $item['title'] );
        if( isset( $item['description'] ) ) $this->set_description( $item['description'] );
        if( isset( $item['price'] ) ) $this->set_price( $item['price'] );
        if( isset( $item['weight'] ) ) $this->set_weight( $item['weight'] );
    }

    public function set_title($title) {return $this->title = $title;}
    public function set_description($description) {return $this->description = $description;}
    public function set_price($price) {return $this->price = $price;}

    public function set_weight($items) {

        // if( !isset( $items['weight'] ) ) return false;

        // Convert to Lbs to OZ
        if( $items['unit'] == 'lbs' ) {
            
            $items['weight'] = $items['weight'] * 16;

        } 

        return  $this->weight = array( 'weight' => $items['weight'], 'unit' => 'oz' );
            // return $this->weight = $items['weight'] * 16;

    }
    

}

class Sales extends Products {

    public $shipping_price;
    public $tax;
    public $final_price;
    public $units = 1;

    public function __construct( $item = array() ) {
        if( isset( $item['title'] ) ) $this->set_title( $item['title'] );
        if( isset( $item['description'] ) ) $this->set_description( $item['description'] );
        if( isset( $item['price'] ) ) $this->set_price( $item['price'] );
        if( isset( $item['weight'] ) ) $this->set_weight( $item['weight'] );
        if( isset( $item['units'] ) ) $this->units = $item['units'];

        $this->set_shipping_price();
        $this->set_tax();
        $this->set_final_price();
    }

    public function set_shipping_price() {
        $this->shipping_price = ($this->weight['weight'] * .7) * $this->units;
        return $this->shipping_price;
    }

    public function set_tax() {
        $this->tax = ($this->price * .1025) * $this->units;
        return $this->tax;
    }

    public function set_final_price() {
        $this->final_price = $this->set_shipping_price() + $this->set_tax() + ($this->price * $this->units);
        return $this->final_price;
    }

}

$items = []; // Made $items into an array to easily loop through them in our future foreach


$item_params1 = array(
    'title' => 'Hotdog',
    'description' => 'Food',
    'price' => 2,
    'weight' => array(
        'weight' => 1,
        'unit' => 'lbs'
    )
);
$items['Hotdog'] = new Sales($item_params1); // This will add a new array.

$item_params2 = array(
    'title' => 'Hamburger',
    'description' => 'Food',
    'price' => 5,
    'weight' => array(
        'weight' => 2,
        'unit' => 'lbs'
    )
);
$items['Hamburger'] = new Sales($item_params2);

$item_params3 = array(
    'title' => 'Grilled Cheese',
    'description' => 'Food',
    'price' => 8,
    'units' => 2,
    'weight' => array(
        'weight' => 3,
        'unit' => 'lbs'
    )
);
$items['Grilled Cheese'] = new Sales($item_params3);

$grand_total_shipping;
$grand_total_tax;
$grand_total;


foreach ($items as $item) {
    echo '<p>Title: ' . $item->title . '</p>';
    echo '<p>Description: ' . $item->description . '</p>';
    echo '<p>Quantity: ' . $item->units . '</p>';
    echo '<p>Weight: ' . $item->weight['weight'] . '</p>';
    echo '<br>';
    echo '<p>Price: $' . $item->price . '</p>';
    echo '<p>Shipping Cost: $' . $item->shipping_price . '</p>';
    echo '<p>Tax: $' . $item->tax . '</p>';
    echo '<p>Total: <b>$' . $item->final_price . '</b></p>';

    echo '<br>';

    $grand_total_shipping += $item->shipping_price;
    $grand_total_tax += $item->tax;
    $grand_total_price += $item->final_price;
}

echo '<p>Total Shipping: $' . $grand_total_shipping . '</p>';
echo '<p>Total Tax: $' . $grand_total_tax . '</p>';
echo '<p>Grand Total: $' . $grand_total_price . '</p>';
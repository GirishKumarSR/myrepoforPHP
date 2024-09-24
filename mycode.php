<?php
// File: Product.php

// A simple Product class to manage product details
class Product {
    // Properties
    private $id;
    private $name;
    private $price;

    // Constructor
    public function __construct($id, $name, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    // Method to get product name
    public function getName() {
        return $this->name;
    }

    // Method to get product price
    public function getPrice() {
        return $this->price;
    }
}

// File: Order.php

// A simple Order class to manage an order
class Order {
    // Properties
    private $orderId;
    private $products = [];
    private $totalAmount = 0;

    // Constructor
    public function __construct($orderId) {
        $this->orderId = $orderId;
    }

    // Method to add a product to the order
    public function addProduct(Product $product) {
        $this->products[] = $product;
        $this->totalAmount += $product->getPrice();
    }

    // Method to display the order summary
    public function getOrderSummary() {
        echo "Order ID: " . $this->orderId . "\n";
        echo "Products in the order:\n";
        foreach ($this->products as $product) {
            echo "- " . $product->getName() . " : $" . $product->getPrice() . "\n";
        }
        echo "Total Amount: $" . $this->totalAmount . "\n";
    }
}

// File: index.php
// Including classes (using require or autoload)
// Assume the classes are stored in separate files
require 'Product.php';
require 'Order.php';

// Creating products
$product1 = new Product(1, "Laptop", 1000);
$product2 = new Product(2, "Smartphone", 600);

// Creating an order
$order = new Order(12345);

// Adding products to the order
$order->addProduct($product1);
$order->addProduct($product2);

// Displaying the order summary
$order->getOrderSummary();
?>

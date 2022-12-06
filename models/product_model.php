<?php


$absolute_root_path =  $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path."/classes.php");

//responsible for CRUD operations on domain object Product
class ProductModel
{

    //gets Products that are display on index page as featured
    //returns array of Products
    public static function getFeaturedProducts()
    {
        //connecting to the database
        DBBroker::connect();

        //number of featured products shown on index page
        $limit = 4;

        //query to SELECT only specific number of products
        $query = "SELECT * FROM products LIMIT ?";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param("i", $limit);

        //executing query
        $stmt->execute();

        //keep result set in a variable
        $result_set = $stmt->get_result();

        //create empty array for Products
        $featured_products = array();

        //loop over every row of the result set
        while ($row = mysqli_fetch_array($result_set)) {

            //retrieve data from row and create Product to add in array
            //of featured products
            $featured_products[] = new Product(
                $row['product_id'],
                $row['product_name'],
                $row['product_price'],
                $row['product_description'],
                $row['product_image'],
                $row['product_image2'],
                $row['product_image3'],
                $row['product_image4']
            );
        }

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //return fetched featured products
        return $featured_products;
    }

    //gets number of all products in database
    //returns integer
    public static function getNumberOfProducts()
    {
        //connecting to the database
        DBBroker::connect();

        //query to SELECT all order items for a specific order
        $query = "SELECT COUNT(*) AS total_records FROM products";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //executing statement
        $stmt->execute();

        //keep result set in a variable
        $result = $stmt->get_result();

        //get integer value (number of products) from result set 
        $number_of_products =  $result->fetch_assoc()['total_records'];

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //return fetched number of product records
        return $number_of_products;
    }

    //gets Products according to the given offset and total records per page
    //returns array of Products
    public static function getProductsPerPage($offset, $total_records_per_page)
    {
        //connecting to the database
        DBBroker::connect();

        //query to SELECT ? number of products skipping ? products
        $query = "SELECT * FROM products LIMIT ?, ?";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param('ii', $offset, $total_records_per_page);

        //executing statement
        $stmt->execute();

        //keep result set in a variable
        $result_set = $stmt->get_result();

        //create empty array of Products
        $products_per_page = array();

        //loop over every row of the result set
        while ($row = mysqli_fetch_array($result_set)) {
            //add Product from the row into products per page array
            $products_per_page[] = new Product(
                $row['product_id'],
                $row['product_name'],
                $row['product_price'],
                $row['product_description'],
                $row['product_image'],
                $row['product_image2'],
                $row['product_image3'],
                $row['product_image4'],
            );
        }

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //return fetched products per page
        return $products_per_page;
    }
    
    //get product by product_id
    //returns Product
    public static function getProductById($product_id)
    {

        //connecting to the database
        DBBroker::connect();

        //query to SELECT product with given product_id
        $query = "SELECT * FROM products WHERE product_id = ?";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param("i", $product_id);

        //executing statement
        $stmt->execute();

        //keep result set in a variable
        $result_set = $stmt->get_result();

        //fetch results into a row
        $row = $result_set->fetch_assoc();

        //retrieving data from row array
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_image = $row['product_image'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];
        $product_image4 = $row['product_image4'];
        $product_price = $row['product_price'];

        //creating new Product object
        $product = new Product(
            $product_id,
            $product_name,
            $product_price,
            $product_description,
            $product_image,
            $product_image2,
            $product_image3,
            $product_image4,
        );

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //returns a Product with given product_id
        return $product;
    }
}
?>
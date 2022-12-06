<?php


$absolute_root_path = $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path . "/classes.php");

session_start();


//usere selected certain page number
if (isset($_GET['page_no'])) {

  //store current page number in a variable (to display next, previous page, etc.)
  $page_no = $_GET['page_no'];

//user failed to provide number of page
} else {
  //default page: first
  $page_no = 1;
}

//get total number of products from db
$total_records = ProductModel::getNumberOfProducts();

//number of products shown on one page
$total_records_per_page = 2;

//number of Products to skip in db
$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

//compute total number of pages
$total_no_of_pages = ceil($total_records / $total_records_per_page);

//get products for specific page using offset and total records per page
$products = ProductModel::getProductsPerPage($offset, $total_records_per_page);



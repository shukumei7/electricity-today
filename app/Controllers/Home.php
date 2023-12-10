<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
{
    // Get the database service
    $db = \Config\Database::connect();

    // Get all the table names as an array
    $tables = $db->listTables();

    // Initialize an empty string to store the HTML output
    $output = "<h1>Table Names</h1><ul>";

    // Loop through the table names and add them to the output
    foreach ($tables as $table) {
        $output .= "<li>" . $table . "</li>";
    }

    $output .= "</ul>";

    // Return the output
    return $output;
}

}

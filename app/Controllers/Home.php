<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        helper('database');
        // Get all the table names as an array
        $tables = db_list_tables();

        // Loop through the table names and display them
        echo "<h1>Table Names</h1>";
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>" . $table . "</li>";
        }
        echo "</ul>";

        // Get the structure of a specific table as a result object
        $query = db_query("DESCRIBE my_table");

        // Get the result as an array
        $data['fields'] = $query->getResultArray();

        // Load the view and pass the data
        return view('welcome_message', $data);
    }

}

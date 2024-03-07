<?php

// namespace App\Models;

class Listing {
    public static function all() {
        return [
            [
            'id' => 1,
            'title' => 'Test 1',
            'description' => "Test Description"
            ],
            [
            'id' => 2,
            'title' => 'Test 2',
            'description' => "Test Description"
            ]
            ];
    }

    public static function find($id) {
        $listings = self::all();

        foreach ($listings as $listing) {
            if ($listing['id'] == $id) {
                return $listing;
            }
        }
    }
}


?>
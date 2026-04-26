<?php

namespace App\Controllers;

/**
 * Controller Home
 * Sebagai pengontrol default saat aplikasi pertama kali diakses.
 */
class Home extends BaseController
{
    // --- HALAMAN AWAL (LANDING) ---
    // Mengarahkan tampilan utama ke layout dashboard
    public function index(): string
    {
        // Mengembalikan tampilan dashboard sebagai halaman utama
        return view('layouts/dashboard');
    }
}
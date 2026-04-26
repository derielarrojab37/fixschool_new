<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * --- CLASS BASECONTROLLER ---
 * Kelas induk (Parent) yang menyediakan tempat untuk memuat komponen global 
 * agar dapat digunakan oleh semua controller lainnya.
 */
abstract class BaseController extends Controller
{
    /**
     * --- INSTANCE REQUEST ---
     * Menyimpan objek Request utama, baik dari terminal (CLI) maupun browser (HTTP).
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * --- AUTO-LOAD HELPERS ---
     * Daftar helper yang akan dimuat secara otomatis saat class ini dipanggil.
     * Contoh: ['form', 'url', 'html']
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * --- DEKLARASI PROPERTI ---
     * Menyiapkan properti agar tidak terjadi error "Dynamic Property" pada PHP 8.2+.
     */
    // protected $session;

    /**
     * --- INISIALISASI CONTROLLER ---
     * Fungsi yang pertama kali dijalankan saat controller dipanggil.
     * Tempat terbaik untuk memuat Model, Library, atau Service global.
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // PERINGATAN: Jangan hapus baris parent ini agar sistem CI4 tetap berjalan normal
        parent::initController($request, $response, $logger);

        // --- PRELOAD KOMPONEN ---
        // Contoh pemuatan session agar bisa diakses di semua controller:
        // $this->session = \Config\Services::session();
    }
}
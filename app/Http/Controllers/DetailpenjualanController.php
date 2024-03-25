<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DetailpenjualanController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $detailpenjualans = DetailPenjualan::latest()->paginate(5);

        //render view with posts
        return view('detail_penjualan.index', compact('detailpenjualans'));
    }
}

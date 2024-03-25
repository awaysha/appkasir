<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PenjualanController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $penjualans = Penjualan::latest()->paginate(5);

        //render view with posts
        return view('penjualan.index', compact('penjualans'));
    }



    public function create(): View
    {
        return view('penjualan.create');
    }
      
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
          
            'tanggal_penjualan'     => 'required|date',
            'total_harga'   => 'required|numeric'
        ]);

      

        //create post
        Penjualan::create([
           
            'tanggal_penjualan'     => $request->tanggal_penjualan,
            'total_harga'   => $request->total_harga
        ]);

        //redirect to index
        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }


    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $penjualans = Penjualan::findOrFail($id);

       
        //delete post
        $penjualans->delete();

        //redirect to index
        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }



    public function edit(string $id): View
    {
        //get post by ID
        $penjualans = Penjualan::findOrFail($id);

        //render view with post
        return view('penjualan.edit', compact('penjualans'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
          
            'tanggal_penjualan'     => 'required',
            'total_harga'     => 'required',
        ]);


        //get post by ID
        $penjualans = Penjualan::findOrFail($id);

     

            //update post without image
            $penjualans->update([
                'tanggal_penjualan'     => $request->tanggal_penjualan,
                'total_harga'     => $request->total_harga,
            ]);
       

        //redirect to index
        return redirect()->route('penjualan.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
}

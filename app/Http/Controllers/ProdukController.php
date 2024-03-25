<?php

namespace App\Http\Controllers;

//import Model "Post
use App\Models\Produk;

//return type View
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get posts
        $produks = Produk::latest()->paginate(5);

        //render view with posts
        return view('produk.index', compact('produks'));
    }



    public function create(): View
    {
        return view('produk.create');
    }
      
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
          
            'nama_produk'     => 'required',
            'harga'     => 'required|numeric|min:0',
            'stok'   => 'required|numeric|min:0'
        ]);

      

        //create post
        Produk::create([
           
            'nama_produk'     => $request->nama_produk,
            'harga'     => $request->harga,
            'stok'   => $request->stok
        ]);

        //redirect to index
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }



    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $produks = Produk::findOrFail($id);

       
        //delete post
        $produks->delete();

        //redirect to index
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


    public function edit(string $id): View
    {
        //get post by ID
        $produks = Produk::findOrFail($id);

        //render view with post
        return view('produk.edit', compact('produks'));
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
          
            'nama_produk'     => 'required',
            'harga'     => 'required',
            'stok'   => 'required'
        ]);


        //get post by ID
        $produks = Produk::findOrFail($id);

     

            //update post without image
            $produks->update([
                'nama_produk'     => $request->nama_produk,
                'harga'     => $request->harga,
                'stok'   => $request->stok
            ]);
       

        //redirect to index
        return redirect()->route('produk.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
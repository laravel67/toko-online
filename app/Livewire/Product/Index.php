<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;

    public $search = '';
    public $title, $price, $deskripsi, $category_id, $image, $imageOld;

    public $editedDataId;
    public $isEditing = false;
    public $delete_id;

    public $formVisible;
    public $formUpdate = false;

    protected $rules = [
        'title' => 'required|min:3',
        'deskripsi' => 'required|max:255',
        'price' => 'numeric|required',
        'image' => 'image|max:1024|nullable',
    ];
    // protected $listeners = [
    //     'formClose' => 'formCloseHandler',
    //     'stored' => 'storedHandler',
    //     'updated' => 'updatedHandler'
    // ];

    protected $updatesQueryString = [
        ['search' => ['except' => '']],
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {

        return view('livewire.product.index', [
            'products' => $this->search == null ?
                Product::latest()->paginate($this->paginate) :
                Product::latest()->where('title', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    // Store
    public function store()
    {
        $this->validate([
            'title' => 'required|min:3',
            'deskripsi' => 'required|max:255',
            'price' => 'numeric|required',
            'image' => 'image|max:1024'
        ]);
        if ($this->image) {
            $imageName = pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName .= '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public/products', $imageName);
            $this->image = $imageName;
        }
        Product::create([
            'title' => $this->title,
            'deskripsi' => $this->deskripsi,
            'price' => $this->price,
            'image' => $this->image,
            // 'category_id' => $this->category_id
        ]);
        $this->resetForm();
        session()->flash('message', 'Produk berhasil disimpan!');
    }
    // Edit
    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $this->title = $data->title;
        $this->price = $data->price;
        $this->deskripsi = $data->deskripsi;
        $this->image = $data->image;
        $this->imageOld = asset('storage/products/' . $data['image']);

        $this->editedDataId = $data->id;
        $this->isEditing = true;
    }
    // Update
    public function update()
    {
        $this->validate();

        if ($this->editedDataId) {
            $product = Product::find($this->editedDataId);
            $image = $product->image; // Tetapkan nilai awal sebagai default

            if ($this->image) {
                // Hapus gambar lama jika ada
                if ($product->image) {
                    Storage::delete('public/products/' . $product->image);
                }
                // Simpan gambar yang baru di storage
                $imageName = pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName .= '.' . $this->image->getClientOriginalExtension();
                $this->image->storeAs('public/products', $imageName);
                $image = $imageName;
            }

            // Gunakan metode update() pada model Eloquent untuk mengupdate record
            $values = [
                'title' => $this->title,
                'deskripsi' => $this->deskripsi,
                'price' => $this->price,
                'image' => $image, // Gunakan $image yang sudah diupdate
            ];

            // Gunakan metode update() pada model Eloquent untuk mengupdate record
            $product->update($values);

            $this->resetForm();
            session()->flash('message', 'Produk berhasil diubah!');
        }
    }
    private function resetForm()
    {
        $this->title = '';
        $this->price = '';
        $this->deskripsi = '';
        $this->image = '';
        $this->isEditing = false;
        $this->editedDataId = null;
    }
    public function cancel()
    {
        $this->resetForm();
    }
    public function destroy($delete_id)
    {
        $product = Product::find($delete_id);
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }
        $product->delete();
        session()->flash('message', 'Produk berhasil dihapus!');
    }





    // public function formCloseHandler()
    // {
    //     $this->formVisible = false;
    // }

    // public function storedHandler()
    // {
    //     session()->flash('message', 'Produk berhasil disimpan');
    // }

    // public function updatedHandler()
    // {
    //     // $this->formVisible = false;
    //     session()->flash('message', 'Produk berhasil diubah');
    // }
    // public function editProduct($productId)
    // {
    //     // $this->formUpdate = true;
    //     // $this->formVisible = true;
    //     // $product = Product::find($productId);

    //     // $this->dispatch('editProduct', $product);
    // }
}

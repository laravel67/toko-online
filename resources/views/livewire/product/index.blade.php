<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">LIST PRODUK</div>
            <div class="card-body">
              <div class="mb-2">
                <hr>
               @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="bi bi-check-circle-fill"></i></strong> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
              </div>
                <div class="row mb-3">
                    <div class="col-2">
                        <select wire:model.live="paginate" class="form-control w-auto">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                    <div class="col">
                        <input wire:model.live="search" class="form-control mr-sm-2" type="text" placeholder="Cari produk...">
                    </div>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="scope">No</th>
                            <th class="scope">Gambar</th>
                            <th class="scope">Nama Produk</th>
                            <th class="scope">Harga</th>
                            <th class="scope">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index=> $p )
                            <tr>
                                <th class="scope">{{ $products->firstItem() + $index }}</th>
                                <td>
                                    <img width="200" src="{{ asset('storage/products/'. $p->image) }}" alt="" srcset="">
                                <td>{{ $p->title }}</td>
                                <td>Rp. {{ number_format($p->price,2,",",".") }}</td>
                                <td>
                                    <button wire:click="edit({{ $p->id }})" class="btn btn-warning text-light">Edit</button>
                                    <button wire:click="destroy({{ $p->id }})" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{{ $products->links() }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
               @if (! $isEditing)
                   Tambah Produk
                @else
                Update Produk
               @endif
            </div>
        </div>
        @include('livewire.product.create')
    </div>
</div>

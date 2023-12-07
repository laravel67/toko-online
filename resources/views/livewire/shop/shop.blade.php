<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <input wire:model.live="search" type="text" class="form-control" placeholder="Cari produk..">
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($products as $product )
         <div class="col-sm-12 col-xs-12 col-md-4 col-lg-3 mb-4">
           <div class="card h-80">
            <img class="card-img"
                src="{{ $product->image ? asset('storage/products/' .$product->image) : 'https://placehold.jp/008a22/ffffff/150x150.png' }}"
                alt="">
            <div class="card-img-overlay" style="background-color: rgba(56, 47, 47, 0.5)">
                <h3 class="text-white">{{ $product->title }}</h3>
                <h6 class="text-white">Rp{{ number_format($product->price,2,",",".") }}</h6>
                <p class="card-text text-white">{{ $product->deskripsi }}</p>
                <button wire:click.live="addToCart({{ $product->id }})" class="btn btn-outline-secondary btn-block">Add to cart</button>
            </div>
        </div>
        </div>   
        @endforeach
    </div>
    {{ $products->links() }}
</div>

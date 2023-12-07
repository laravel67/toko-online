<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart['products'] as $p )
                            <tr>
                                <td>
                                    @if ($p->image)
                                    <div style="width: 50px">
                                        <img src="{{ asset('storage/products/'. $p->image) }}" alt="" class="card-img-top" width="30">
                                    </div>
                                    @else
                                    <div style="width: 50px">
                                        <img src="https://placehold.jp/008a22/ffffff/50x50.png" alt="" class="card-img-top" width="30">
                                    </div>
                                    @endif
                                </td>
                                <td>{{ $p->title }}</td>
                                <td>Rp. {{ number_format($p->price,2,",",".") }}</td>
                                <td><button wire:click="removeCart({{ $p->id }})" class="btn btn-danger">Hapus</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <a href="{{ route('checkout') }}" class="btn btn-success float-right">Checkout</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
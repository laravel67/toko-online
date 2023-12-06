<form method="POST" wire:submit.prevent="{{ $isEditing ? 'update' : 'store'  }}"
    id="{{ $isEditing ? 'editForm':'createForm'}}" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="title">Nama Produk</label>
            <input type="text" wire:model='title' name="title" class="form-control @error('title')
                                is-invalid
                            @enderror" id="title" placeholder="nama produk" value="{{ old('title') }}">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="price">Harga Produk</label>
            <input type="number" wire:model='price' class="form-control @error('price')
                                is-invalid
                            @enderror" id="price" placeholder="harga produk" value="{{ old('price') }}">
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea wire:model='deskripsi' name="deskripsi" id="deskripsi" class="form-control @error('deskripsi')
                        is-invalid
                    @enderror">{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Gambar Produk</label>
        
            {{-- Check if not editing --}}
            @if (!$isEditing)
            <input type="file" wire:model="image" name="image" id="imageInput"
                class="form-control-file mb-2 @error('image') is-invalid @enderror">
            {{-- Display temporary image preview if available --}}
            @if ($image && is_object($image))
            <img width="200" class="img-fluid img-preview" src="{{ $image->temporaryUrl() }}">
            @endif
            {{-- Editing mode --}}
            @else
            <input type="file" wire:model="image" name="image" id="imageInput"
                class="form-control-file mb-2 @error('image') is-invalid @enderror">
            {{-- Display new image preview if available --}}
            @if ($image && is_object($image))
            <img width="200" class="img-fluid img-preview" src="{{ $image->temporaryUrl() }}">
            {{-- Display old image with a preview and a message --}}
            @elseif ($imageOld)
            <img width="200" class="img-fluid img-preview" src="{{ $imageOld }}">
            <p class="text-muted">Gambar saat ini</p>
            @endif
        
            @endif
        </div>
        {{-- <div class="form-group col-md-6">
            <label for="category_id">Kategori</label>
            <select wire:model='category_id' id="category_id" class="form-control">
                <option selected>Choose Kategori...</option>
                @foreach ($categories as $cat )
                @if (old('category_di')== $cat->id)
                <option value="{{$cat->id  }}" selected>{{ $cat->name }}</option>
                @else
                <option value="{{$cat->id  }}">{{ $cat->name }}</option>
                @endif
                @endforeach
            </select>
        </div> --}}
    </div>
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="submit" class="btn btn-success">
            @if ($isEditing)
            Ubah
            @else
            Simpan
            @endif
        </button>
        @if ($isEditing)
            <button wire:click="cancel" type="button" class="btn btn-danger">Batal</button>
        @endif
    </div>
</form>

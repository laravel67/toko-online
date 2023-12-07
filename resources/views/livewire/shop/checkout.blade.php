<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Checkout</div>
            <div class="card-body">
                @if ($formCheckOut)
                <form wire:submit.prevent="checkout">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Firt Name</label>
                            <input wire:model='first_name' value="{{ $first_name }}" type="text" class="form-control @error('first_name')
                                is-invalid
                            @enderror" placeholder="first name">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Last Name</label>
                            <input wire:model='last_name' value="{{ $last_name }}" type="text" class="form-control @error('last_name')
                                is-invalid
                            @enderror" placeholder="last name">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >Email</label>
                            <input wire:model='email' value="{{ $email }}" type="email" class="form-control @error('email')
                                is-invalid
                            @enderror" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label >Telphone</label>
                            <input wire:model='phone' value="{{ $phone }}" type="number" class="form-control @error('phone')
                                is-invalid
                            @enderror" placeholder="nomor telpon">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea wire:model='address' class="form-control @error('address')
                                is-invalid
                            @enderror">{{ $address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >City</label>
                            <input wire:model='city' value="{{ $city }}" type="text" class="form-control @error('address')
                                is-invalid
                            @enderror">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>Postal Code</label>
                            <input wire:model='postal_code' value="{{ $postal_code }}" type="text" class="form-control @error('postal_code')
                                is-invalid
                            @enderror">
                            @error('postal_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
                @else
                   <button type="submit" wire:click="$dispatch('payment', '{{ $snapToken }}')" id="pay-button" class="btn btn-success btn-block">Pay Now</button>
                @push('scripts')
                <script type="text/javascript">
                    document.addEventListener('livewire:load', function () {
                            Livewire.on('payment', function (snapToken) {
                                var payButton = document.getElementById('pay-button');
                                payButton.addEventListener('click', function () {
                                    window.snap.pay(snapToken, {
                                        onSuccess: function (result) {
                                            alert('payment success')
                                            console.log(result);
                                        },
                                        onPending: function (result) {
                                            alert('waiting payment')
                                            console.log(result);
                                        },
                                        onError: function (result) {
                                            alert('payment failed')
                                            console.log(result);
                                        },
                                        onClose: function (result) {
                                            alert('you closed without finishing payment')
                                            console.log(result);
                                        },
                                    })
                                });
                            });
                        });
                </script>
                @endpush

                @endif
            </div>
        </div>
    </div>
</div>
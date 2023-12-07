<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Checkout</div>
            <div class="card-body">
                <h1>Menunggu Pembayaran</h1>
                <button type="submit" id="pay-button" class="btn btn-success btn-block">Pay Now</button>
                <script type="text/javascript">
                    var payButton = document.getElementById('pay-button');
                            payButton.addEventListener('click', function(){
                                window.snap.pay('{{$snapToken}}',{
                                    onSuccess: function (result){
                                        alert('payment success')
                                        console.log(result);
                                    },
                                    onPending: function (result){
                                        alert('waiting payment')
                                        console.log(result);
                                    },
                                    onError: function (result){
                                        alert('payment failed')
                                        console.log(result);
                                    },
                                    onClose: function (result){
                                        alert('you closed whithout finishing payment')
                                        console.log(result);
                                    },
                                })
                            });
                </script>
            </div>
        </div>
    </div>
</div>

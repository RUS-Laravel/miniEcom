<form action="{{ route('cart.buy') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-info fade in alert-dismissible" role="alert">
                <b>{{ auth('client')->user()->name }} {{ auth('client')->user()->surname }}</b>
            </div>

            <input name="telephone" type="text" placeholder="Telefon">
            <textarea name="address" placeholder="Address" rows="3"></textarea>

            <div class="col-md-12 mb-30">
                <h6>Payment Type</h6>
                <ul class="radio-buttons">
                    <li>
                        <input type="radio" class="input-radio" name="payment_type" id="radio1" value="cash" checked="checked">
                        <label for="radio1">Cash</label>
                    </li>
                    <li>
                        <input type="radio" class="input-radio" name="payment_type" id="radio2" value="cart">
                        <label for="radio2">Credit Cart</label>
                    </li>
                </ul>
            </div>
            <button type="submit" class="btn btn-lg btn-green mb-30 btn-block"><span>Buy Now</span></button>
        </div> <!-- end col -->
    </div> <!-- end row -->


</form>

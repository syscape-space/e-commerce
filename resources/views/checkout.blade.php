@extends('layout.app')


@section('content')
<div class="container">
<h2>Checkout</h2>


<h3>Shipping Information</h3>

<form action="" method="post">
    {{-- {{route('orders.store')}} --}}
    @csrf
    <div class="form-group"> 
        <label for="">Full Name</label>
        <input type="text" name="shipping_fullname" class="form-control @error('shipping_fullname') is-invalid @enderror " id="" aria-describedby=""
          placeholder="Enter your full name">
        @error('shipping_fullname')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

    <div class="form-group"> 
        <label for="">state</label>
        <input type="text" name="shipping_state" class="form-control @error('shipping_state') is-invalid @enderror " id="" aria-describedby=""
          placeholder="Enter your state">
        @error('shipping_state')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

    <div class="form-group"> 
        <label for="">city</label>
        <input type="text" name="shipping_city" class="form-control @error('shipping_city') is-invalid @enderror " id="" aria-describedby=""
          placeholder="Enter your city">
        @error('shipping_city')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

    <div class="form-group"> 
        <label for="">zipcode</label>
        <input type="text" name="shipping_zipcode" class="form-control @error('shipping_zipcode') is-invalid @enderror " id="" aria-describedby=""
          placeholder="Enter your zipcode">
        @error('shipping_zipcode')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

    <div class="form-group"> 
        <label for="">Full Adderss</label>
        <input type="text" name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror " id="" aria-describedby=""
          placeholder="Enter your full address">
        @error('shipping_address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

    <div class="form-group"> 
        <label for="">Mobile</label>
        <input type="text" name="shipping_phone" class="form-control @error('shipping_phone') is-invalid @enderror " id="" aria-describedby=""
          placeholder="Enter your mobile number">
        @error('shipping_phone')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
    </div>

    <h4>Payment option</h4>

    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" checked class="form-check-input" name="payment_method" id="" value="cash_on_delivery">
            Cash on delivery

        </label>

    </div>

    <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="payment_method" id="" value="paypal">
            Paypal

        </label>

    </div>


    <a href="" class="btn btn-primary mt-3">Place Order</a>
    {{-- {{route('')}} --}}

</form>

</div>
@endsection
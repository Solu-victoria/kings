@include ('header');
<style>

body {
    background-color: #f5f5f5;
    }
    .cart-container {
      margin-top: 50px;
    }
    .cart-item {
      margin-bottom: 20px;
      padding: 10px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    .item-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .item-actions {
      display: flex;
      align-items: center;
    }
    .btn-danger {
      margin-left: 10px;
    }
    .btn-primary {
      margin-right: 10px;
    }
      </style>
        <!--cart start-->
        <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="cart-container">
                  <h2>Your Ordering Cart</h2>
                  @if(session()->has('message_cart'))
                        <div class="alert alert-success">
                            {{ session()->get('message_cart') }}
                        </div>
                  @endif

                  @php
                  $total = 0;

                  foreach ($cart as $cart_item) {
                  $total += $cart_item->quantity;
                  }
                  @endphp
                  <p>Total Items in Cart: <span id="totalItems">{{$total}}</span></p>
                  @foreach ($cart as $cart_item)
                  <div class="cart-item">
                    <div class="item-info">
                      <div>
                        <h4>{{$cart_item->food->fname}}</h4>
                        <p>Price: #<span class="price">{{$cart_item->food->price}}</span></p>
                      </div>
                      <div>
                        <div class="item-actions">
                          <button class="btn btn-secondary" onclick="decreaseQuantity(this)">-</button>
                          <span class="mx-2">{{$cart_item->quantity}}</span>
                          <button class="btn btn-secondary" onclick="increaseQuantity(this)">+</button>
                          
                        </div>
                        <p>Total: #<span class="totalPrice">{{$cart_item->food->price * $cart_item->quantity}}</span></p>
                        <div class="item-actions">
                          <form action="{{ route('cartUpdate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input class="quantityInput" type="hidden" name="quantity" value="">
                            <input type="hidden" name="cart_item_id" value="{{$cart_item->id}}">
                            <button type='submit' class="btn btn-primary">Update</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="item-actions">
                      <form action="{{ route('cartRemove') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="cart_item_id" value="{{$cart_item->id}}">
                        <button type='submit' class="btn btn-danger">Remove</button>
                      </form>
                    </div>
                  </div>
                  @endforeach
                  @if (count($cart) != 0)
                  <div class="text-right">
                    <a class="btn btn-primary" href="checkout">Proceed to Checkout</a>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          
         <!--cart start-->
        
         @include ('footer');

    <script>
        // Function to increase quantity
        function increaseQuantity(button) {
          var quantityElement = button.parentElement.querySelector('span');
          var container = button.closest('.item-info');
          var inputElement = container.querySelector('.quantityInput');
          var currentQuantity = parseInt(quantityElement.textContent);
          quantityElement.textContent = currentQuantity + 1;
          inputElement.value = currentQuantity + 1;
       
          var priceElement = container.querySelector('.price');
          var totalPriceElement = container.querySelector('.totalPrice');

          var price = parseInt(priceElement.textContent);
          totalPriceElement.textContent = quantityElement.textContent * price;
          updateTotalItems();
        }
      
        // Function to decrease quantity
        function decreaseQuantity(button) {
          var quantityElement = button.parentElement.querySelector('span');
          var container = button.closest('.item-info');
          var inputElement = container.querySelector('.quantityInput');
          var currentQuantity = parseInt(quantityElement.textContent);
          if (currentQuantity > 1) {
            quantityElement.textContent = currentQuantity - 1;
            inputElement.value = currentQuantity - 1;

            var priceElement = container.querySelector('.price');
            var totalPriceElement = container.querySelector('.totalPrice');

            var price = parseInt(priceElement.textContent);
            totalPriceElement.textContent = quantityElement.textContent * price;
            updateTotalItems();
          }
        }
      
        // Function to update total items in cart
        function updateTotalItems() {
          var totalItemsElement = document.getElementById('totalItems');
          var cartItems = document.querySelectorAll('.cart-item');
          var totalItems = 0;
          cartItems.forEach(function(item) {
            var quantity = parseInt(item.querySelector('.item-actions').querySelector('span').textContent);
            totalItems += quantity;
          });
          totalItemsElement.textContent = totalItems;
        }
      </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
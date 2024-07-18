<div class="col-lg-3">
    <div class="pt-2 text-center card">
        @if (Auth::guard('customer')->user()->photo == null)
            <img class="m-auto" width="70"
                src="{{ Avatar::create(Auth::guard('customer')->user()->fname . ' ' . Auth::guard('customer')->user()->lname)->toBase64() }}" />
        @else
            <img class="m-auto" width="70"
                src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}" class="card-img-top"
                alt="...">
        @endif
        <div class="card-body">
            <h5 class="card-title">
                {{ Auth::guard('customer')->user()->fname . ' ' . Auth::guard('customer')->user()->lname }}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="py-3 list-group-item bg-light"><a href="{{ route('customer.profile') }}" class="text-dark">Profile</a></li>
            <li class="py-3 list-group-item bg-light"><a href="{{ route('my.orders') }}" class="text-dark">My
                    Order</a></li>
            <li class="py-3 list-group-item bg-light"><a href="" class="text-dark">My Wishlist</a></li>
            <li class="py-3 list-group-item bg-light"><a href="{{ route('customer.logout') }}"
                    class="text-dark">Logout</a></li>
        </ul>
    </div>
</div>

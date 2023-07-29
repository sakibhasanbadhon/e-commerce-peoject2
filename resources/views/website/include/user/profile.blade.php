<div class="card">
    <div class="image-div">
        <img style="width: 155px;height: 150px; border: 8px solid #f2f2f2;" src="{{ asset('/') }}assets/img/admin-avatar.png" class="profile-image mx-auto mt-4 card-img-top rounded rounded-circle">

    </div>
    <div class="middle zoom-in">
      <!-- <div class="text">John Doe</div> -->
      <button class="btn btn-outline-info px-4">edit</button>
    </div>

    <div class="card-body">
      <h5 class="card-title text-center"> {{ Auth::user()->name ?? 'Unknown' }} </h5>
      <p class="card-text text-center">Email: john.doe@example.com</p>
      <p class="card-text text-center">Location: New York, USA</p>

      <ul class="list-inline text-dark">
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('write.review') }}">Dashboard</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="">Edit Profile</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('wishlist') }}">Wishlist</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="">My Order</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="">Setting</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="">Open Ticket</a>
        </li>
        <li style="border-top:1px solid #f2f2f2" class="py-2">
            <a class="text-secondary text-decoration-none" href="{{ route('customer.logout') }}">Logout</a>
        </li>
      </ul>

    </div>
  </div>

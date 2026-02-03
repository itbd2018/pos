 <header class="main-header navbar shadow bg-white rounded">
    <div class="col-search">
        <!-- <a class="nav-link d-inline-block" target="_blank" href=""><i class="fas fa-globe me-2"></i>Visit Site</a> -->

        <a class="btn btn-sm btn-danger nav-link d-inline-block" href="{{ route('cache.clear')}}"><i class="fa-solid fa-refresh"></i></a>
        </a>

         <a class="btn btn-sm btn-success nav-link d-inline-block" href="{{ route('pos.index') }}"><i class="fab fa-product-hunt"></i></a>
    </div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
        <ul class="nav">
            <?php
                use App\Models\User;
                $id = Auth::guard('admin')->user()->id;
                $adminData = User::find($id);
            ?>

            <li class="dropdown nav-item">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false">
                    @if(Auth::guard('admin')->user()->role == 2)
                    <img class="img-xs rounded-circle" src="{{ (!empty($adminData->profile_image))? asset($adminData->profile_image):url('upload/no_image.jpg') }}" alt="User Avatar">
                    @else
                    <img class="img-xs rounded-circle" src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="User Avatar">
                    @endif
                    
                    </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="material-icons md-perm_identity"></i>My Profile</a>
                    <a class="dropdown-item" href="#"><i class="material-icons md-settings"></i>Account Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i class="material-icons md-exit_to_app"></i>Logout</a>
                </div>
            </li>
        </ul>
    </div>
</header>

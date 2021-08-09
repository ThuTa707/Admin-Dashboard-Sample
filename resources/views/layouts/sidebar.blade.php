<div class="col-12 col-lg-3 col-xl-2 vh-100 sidebar">
    <div class="d-flex justify-content-between align-items-center py-2 mt-3 nav-brand">
        <div class="d-flex align-items-center">
            <span class="bg-primary p-2 rounded d-flex justify-content-center align-items-center mr-2">
                <i class="feather-shopping-bag text-white h4 mb-0"></i>
            </span>
            <span class="font-weight-bolder h4 mb-0 text-uppercase text-primary"> KC Shop</span>
        </div>
        <button class="hide-sidebar-btn btn btn-light d-block d-lg-none">
            <i class="feather-x text-primary" style="font-size: 2em;"></i>
        </button>
    </div>
    <div class="nav-menu">
        <ul>

            <x-menu-spacer />

            <x-menu-item link="{{ route('home') }}" icon="feather-home" name="Home" noti="" />

            <x-menu-title title="Item Management" />
            <x-menu-item link="" icon="feather-plus-circle" name="Create New Item" noti="" />
            <x-menu-item link="" icon="feather-server" name="Item Lists" noti="57" />

            @if (Auth::user()->is_admin == 0)
                <x-menu-title title="User Management" />
                <x-menu-item link="{{ route('admin.show.user') }}" icon="feather-users" name="Users" noti="" />
            @endif




            <x-menu-title title="User Profile" />
            <x-menu-item link="{{ route('profile') }}" icon="feather-user" name="Your Profile" noti="" />
            <x-menu-item link="{{ route('profile.edit.password') }}" icon="feather-refresh-ccw" name="Upate Password"
                noti="" />
            <x-menu-item link="{{ route('profile.edit.name-email') }}" icon="feather-message-square" name="Update Info"
                noti="" />
            <x-menu-item link="{{ route('profile.edit.photo') }}" icon="feather-camera" name="Update Photo" noti="" />

            <a class="btn btn-outline-danger btn-block mt-2" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>


            <x-menu-spacer />


        </ul>
    </div>
</div>

{{-- <div class="form-group row">
    <label for="{{$name}}" class="col-md-4 col-form-label text-md-right">{{$name}}</label>

    <div class="col-md-6">
        <input id="{{$name}}" type="{{$type}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" value="{{ old($name) }}">

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div> --}}


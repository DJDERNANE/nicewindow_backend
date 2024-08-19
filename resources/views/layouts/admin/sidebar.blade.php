<div class="sidebar full" id="sidebar">
  <div class="sidebar-logo shadow-sm">
    <img src="{{ asset('assets/admin/images/logo.png') }}" width="100%" class="sidebar-logo-img" />
    <img src="{{ asset('assets/admin/images/brand.png') }}" width="100%" style="display: none;" class="sidebar-brand-img" />
  </div>
  <ul class="sidebar-elements px-3" id="sidebarElements">
    <li class="{{ Route::currentRouteName() == 'admin.home' ? 'active' : '' }} mt-2">
      <div><a href="{{ route('admin.home') }}"><ion-icon name="home-outline"></ion-icon> &nbsp; <span class="se-txt">الرئيسية</span></a></div>
    </li>
    <li class="{{ strpos(Request::url(), 'users') == true ? 'active' : '' }}">
      <div data-bs-toggle="collapse" data-bs-target="#componentsList" aria-expanded="false" aria-controls="componentsList">
        <a href="#">
          <ion-icon name="people-outline"></ion-icon> 
          &nbsp; 
          <span class="se-txt">المستخدمين</span>
          <ion-icon name="chevron-down-outline" class="se-icon float-end px-3 pt-1"></ion-icon>
        </a>
      </div>
      <ul class="collapse list-child" id="componentsList">
        <li>
          <div><a href="{{ route('admin.users', ['type' => 'clients']) }}">الزبائن</a></div>
        </li>
        <li>
          <div><a href="{{ route('admin.users', ['type' => 'carpentries']) }}">النجارين</a></div>
        </li>
        <li>
          <div><a href="{{ route('admin.users', ['type' => 'profile_suppliers']) }}">ناقلي السلع</a></div>
        </li>
      </ul>
    </li>
    <li class="{{ Route::currentRouteName() == 'admin.packages' ? 'active' : '' }}">
      <div><a href="{{ route('admin.packages') }}"><ion-icon name="logo-usd"></ion-icon> &nbsp; <span class="se-txt">الباقات</span></a></div>
    </li>
    <li class="{{ Route::currentRouteName() == 'admin.categories' ? 'active' : '' }}">
      <div><a href="{{ route('admin.categories') }}"><ion-icon name="pricetag-outline"></ion-icon> &nbsp; <span class="se-txt">التصنيفات</span></a></div>
    </li>
    <li class="{{ Route::currentRouteName() == 'admin.subcategories' ? 'active' : '' }}">
      <div><a href="{{ route('admin.subcategories') }}"><ion-icon name="pricetag-outline"></ion-icon> &nbsp; <span class="se-txt">التصنيفات الفرعية</span></a></div>
    </li>
    <li class="{{ Route::currentRouteName() == 'admin.types' ? 'active' : '' }}">
      <div><a href="{{ route('admin.types') }}"><ion-icon name="pricetag-outline"></ion-icon> &nbsp; <span class="se-txt">الأنواع</span></a></div>
    </li>
    <li class="{{ Route::currentRouteName() == 'admin.profiles' ? 'active' : '' }}">
      <div><a href="{{ route('admin.profiles') }}"><ion-icon name="pricetags-outline"></ion-icon> &nbsp; <span class="se-txt">البروفيلات</span></a></div>
    </li>
    <li class="{{ Route::currentRouteName() == 'admin.glass' ? 'active' : '' }}">
      <div><a href="{{ route('admin.glass') }}"><ion-icon name="pricetags-outline"></ion-icon> &nbsp; <span class="se-txt">الزجاج</span></a></div>
    </li>
    <li class="{{ Route::currentRouteName() == 'admin.colors' ? 'active' : '' }}">
      <div><a href="{{ route('admin.colors') }}"><ion-icon name="color-palette-outline"></ion-icon> &nbsp; <span class="se-txt">الألوان</span></a></div>
    </li>
    <li class="{{ strpos(Request::url(), 'order') == true ? 'active' : '' }}">
      <div data-bs-toggle="collapse" data-bs-target="#ordersList" aria-expanded="false" aria-controls="ordersList">
        <a href="#">
          <ion-icon name="cube-outline"></ion-icon> 
          &nbsp; 
          <span class="se-txt">الطلبات</span>
          <ion-icon name="chevron-down-outline" class="se-icon float-end px-3 pt-1"></ion-icon>
        </a>
      </div>
      <ul class="collapse list-child" id="ordersList">
        <li>
          <div><a href="{{ route('admin.orders.profile') }}">طلبات من الناقلين</a></div>
        </li>
        <li>
          <div><a href="{{ route('admin.orders.estimate') }}">طلبات من النجارين</a></div>
        </li>
      </ul>
    </li>
  </ul>
</div>
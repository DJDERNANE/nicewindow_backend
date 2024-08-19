<header class="shadow-sm">
  <div class="container-fluid">
    <ion-icon name="menu-outline" class="header-sidebar-toggle-btn float-start mt-2 pt-1 cursor-pointer" size="large" onclick="toggleSidebar();"></ion-icon>
    <a href="{{ route('home') }}" target="_blank">
      <button class="header-visite-btn float-start btn btn-outline-dark border-dark my-2 mx-3">
        <ion-icon name="eye-outline"></ion-icon> 
      </button>
    </a>
    <ul class="header-list float-end">
      <li class="float-end one-dropdown-container header-list-profile position-relative">
        <img src="{{ !empty(Auth::user()->profile_photo_path) ? Auth::user()->profile_photo_path : asset('assets/admin/images/brand.png') }}" width="28px" style="margin-top: -2px;" class="border border-2 border-muted rounded-pill" />
        <a href="#" class="text-dark">
          <span class="text-white d-sm-none">محمد</span> 
          <ion-icon name="chevron-down-outline" class="text-white"></ion-icon>
        </a>
        <ul class="header-account-list one-dropdown bg-white position-absolute shadow p-0">
          <li class="p-3"><a href="{{ route('admin.profile') }}"><ion-icon name="person-outline"></ion-icon> <span>حسابي</span></a></li>
          <li class="p-3"><a href="#"><ion-icon name="log-out-outline"></ion-icon> <span>خروج</span></a></li>
        </ul>
      </li>
      <li class="header-notification-icon one-dropdown-container float-end py-3 mx-3 position-relative">
        <a href="#"><ion-icon name="notifications-outline" class="h4 text-dark"></ion-icon></a>
        @if (App\Models\AdminNotification::where('status', 0)->count() > 0)          
          <span class="one-badge bg-danger"></span>
        @endif
        <div class="header-notifications-list one-dropdown bg-white position-absolute shadow p-0">
          <div class="header-notifications-list-head bg-dark text-white p-3">
            <b><ion-icon name="notifications-outline" class="ion-vertical"></ion-icon> <span class="ion-vertical">التنبيهات</span></b>
          </div>
          @forelse (App\Models\AdminNotification::orderBy('id', 'DESC')->limit(3)->get() as $notification)
            <div class="p-3 header-notification-elem">
              <a href="{{ $notification->url }}" class="text-dark">
                {{ $notification->content }}
              </a>
            </div>
          @empty
            <div class="text-center py-3">
              لا توجد بيانات
            </div>
          @endforelse
          <div class="header-notifications-all text-center py-1">
            <a href="{{ route('admin.notifications') }}">
              جميع التنبيهات
            </a>
          </div>
        </div>
      </li>
      <li class="header-message-icon one-dropdown-container float-end py-3 mx-2 position-relative">
        <a href="#"><ion-icon name="chatbubble-outline" class="h4 text-dark"></ion-icon></a>
        @if (App\Models\Contactus::where('status', 'unread')->count() > 0)          
          <span class="one-badge bg-danger"></span>
        @endif
        <div class="header-messages-list one-dropdown bg-white position-absolute shadow p-0">
          <div class="header-messages-list-head bg-dark text-white p-3">
            <b><ion-icon name="chatbubble-outline" class="ion-vertical"></ion-icon> <span class="ion-vertical">الرسائل</span></b>
          </div>
          @forelse (App\Models\Contactus::orderBy('id', 'DESC')->limit(3)->get() as $message)
            <div class="p-3 border-bottom header-message-elem clearfix">
              <div class="header-messages-img float-start">
                <img src="{{ asset('assets/admin/images/brand.png') }}" width="100%" />
              </div>
              <div class="header-message-content float-end">
                <a href="{{ route('admin.contactus') }}" class="text-dark">{{ $message->subject }}</a>
              </div>
            </div>
          @empty
            <div class="text-center py-3">
              لا توجد بيانات
            </div>
          @endforelse
          <div class="header-messages-all text-center py-1">
            <a href="{{ route('admin.contactus') }}">
              عرض الجميع
            </a>
          </div>
        </div>
      </li>
    </ul>
  </div>
</header>
<!-- Sidebar Start -->
<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo ">
      <a href="./index.html" class="text-nowrap logo-img">
        <img src="{{ asset('assets/img/logo.png') }}" width="150" class="d-block mx-auto" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.dashboard') }}</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">{{ translate('messages.subscription_plan') }}</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.subscription.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.subscriptions') }}</span>
          </a>
        </li>
        <!-- Business Setting -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">{{ translate('messages.business_settings') }}</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.business-settings.index') }}" aria-expanded="false">
            <span>
              <i class="fas fa-cogs"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.business_setup') }}</span>
          </a>
        </li>

        <!-- Meal Section -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">{{ translate('messages.meal_section') }}</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.meal-category.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-category"></i>
            </span>
            <span class="hide-menu">{{  translate('messages.category')  }}</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.meal-type.index') }}" aria-expanded="false">
            <span>
              <i class="ti ti-menu"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.type') }}</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('admin.meal-item.index') }}" aria-expanded="false">
            <span>
              <i class="fa fa-sitemap"></i>
            </span>
            <span class="hide-menu">{{ translate('messages.meal_item') }}</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
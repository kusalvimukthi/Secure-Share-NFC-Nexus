<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
          <span class="app-brand-logo demo">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
              <style type="text/css">
                .st0 {
                    fill: #5F61E6;
                }

                .st1 {
                    fill: #FFFFFF;
                }
              </style>
              <g>
                <ellipse transform="matrix(0.1639 -0.9865 0.9865 0.1639 -3.7586 45.5656)" class="st0" cx="25" cy="25" rx="24.8" ry="24.8" />
                <g>
                  <path class="st1" d="M9.2,23c-0.4,0-0.8-0.1-1.1-0.4c-0.8-0.6-0.9-1.7-0.3-2.5c0.4-0.5,2.1-2.3,4.8-4.1c3.5-2.3,7.3-3.7,11.1-3.9
                  c6.4-0.4,12.6,2.2,18.4,7.8c0.7,0.7,0.7,1.8,0,2.5c-0.7,0.7-1.8,0.7-2.5,0c-5-4.8-10.2-7.1-15.5-6.8c-4,0.2-7.3,1.9-9.4,3.3
                  c-2.3,1.5-3.8,3.1-4.1,3.4C10.3,22.8,9.7,23,9.2,23z M14.7,26.9c0.4-0.5,4.2-4.6,9.6-4.9c3.7-0.2,7.4,1.5,11.1,5
                  c0.7,0.7,1.9,0.7,2.5-0.1c0.7-0.7,0.7-1.9-0.1-2.5c-4.4-4.2-9-6.2-13.7-6c-6.8,0.3-11.3,5.1-12.2,6.1c-0.7,0.7-0.6,1.9,0.2,2.5
                  c0.3,0.3,0.8,0.4,1.2,0.4C13.9,27.5,14.4,27.3,14.7,26.9z M19,31.5c0.3-0.6,2.4-2.7,5.2-3c2.4-0.3,4.7,0.9,7,3.3
                  c0.7,0.7,1.8,0.8,2.5,0.1c0.7-0.7,0.8-1.8,0.1-2.5c-3.9-4.2-7.6-4.7-10-4.4c-4.1,0.4-7.1,3.4-7.9,4.8c-0.5,0.9-0.2,2,0.6,2.5
                  c0.3,0.2,0.6,0.3,0.9,0.3C18,32.3,18.6,32,19,31.5z M25,31.9c-1.9,0-3.4,1.5-3.4,3.4c0,1.9,1.5,3.4,3.4,3.4c1.9,0,3.4-1.5,3.4-3.4
                  C28.5,33.5,27,31.9,25,31.9z" />
                </g>
              </g>
            </svg>
          </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">NFC Nexus</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item  {{ Request::is('dashboard*') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div class="text-truncate">Dashboard</div>
            </a>
        </li>
        @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item  {{ Request::is('users*') ? 'active' : '' }}">
            <a href="/users" class="menu-link">
                <i class='menu-icon tf-icons bx bx-user-pin' ></i>
                <div class="text-truncate">System Users</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::is('customers*') ? 'active' : '' }}">
            <a href="/customers" class="menu-link">
                <i class='menu-icon tf-icons bx bx-user-circle' ></i>
                <div class="text-truncate">Customers</div>
            </a>
        </li>
        @endif
        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Nexus &amp; Types</span>
        </li>
        @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('business-card-create*') ? 'active' : '' }}">
            <a href="/business-card-create" class="menu-link">
                <i class='menu-icon tf-icons bx bx-credit-card-front' ></i>
                <div class="text-truncate">Create Business Card</div>
            </a>
        </li>
        @endif
        @if(auth()->user()->businessCards()->exists() || auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('cards-view*') ? 'active' : '' }}">
            <a href="/cards-view" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-credit-card-front' ></i>
                <div class="text-truncate">View Business Cards</div>
            </a>
        </li>
        @endif
        @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('create-wallet*') ? 'active' : '' }}">
            <a href="/create-wallet" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div class="text-truncate">Create Secure Wallets</div>
            </a>
        </li>
        @endif
        @if(auth()->user()->wallets()->exists() || auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('wallets-list*') ? 'active' : '' }}">
            <a href="/wallets-list" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-wallet' ></i>
                <div class="text-truncate">View Secure Wallets</div>
            </a>
        </li>
        @endif
        @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('create-custom-card*') ? 'active' : '' }}">
            <a href="/create-custom-card" class="menu-link">
                <i class="menu-icon tf-icons bx bx-id-card"></i>
                <div class="text-truncate">Create Custom Card</div>
            </a>
        </li>
        @endif
        @if(auth()->user()->custom_cards()->exists() || auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('custom-cards-list*') ? 'active' : '' }}">
            <a href="/custom-cards-list" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-id-card' ></i>
                <div class="text-truncate">View Custom Cards</div>
            </a>
        </li>
        @endif
        @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('create-pet-tag*') ? 'active' : '' }}">
            <a href="/create-pet-tag" class="menu-link">
                <i class="menu-icon tf-icons bx bx-smile"></i>
                <div class="text-truncate">Create Pet Tag</div>
            </a>
        </li>
        @endif
        @if(auth()->user()->pet_tags()->exists() || auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('pet-tags-list*') ? 'active' : '' }}">
            <a href="/pet-tags-list" class="menu-link">
                <i class='menu-icon tf-icons bx bxl-baidu' ></i>
                <div class="text-truncate">View Pet Tags</div>
            </a>
        </li>
        @endif
        @if(auth()->check() && auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('create-storage-tag*') ? 'active' : '' }}">
            <a href="/create-storage-tag" class="menu-link">
                <i class='menu-icon tf-icons bx bx-purchase-tag-alt' ></i>
                <div class="text-truncate">Create Storage Tag</div>
            </a>
        </li>
        @endif
        @if(auth()->user()->storage_tags()->exists() || auth()->user()->hasAnyRole(['admin', 'supervisor']))
        <li class="menu-item {{ Request::is('storage-tags-list*') ? 'active' : '' }}">
            <a href="/storage-tags-list" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-purchase-tag-alt' ></i>
                <div class="text-truncate">View Storage Tags</div>
            </a>
        </li>
        @endif
    </ul>

</aside>

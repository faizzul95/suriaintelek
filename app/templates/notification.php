<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
        <i class="bx bx-bell bx-sm"></i>
        <span id="countUnreadNoti" class="badge bg-danger rounded-pill badge-notifications">0</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end py-0">
        <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
                <h5 class="text-body mb-0 me-auto">Notification</h5>
                <a href="javascript:void(0)" onclick="markAllRead()" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
            </div>
        </li>
        <li class="dropdown-notifications-list scrollable-container">
            <ul id="listnotification" class="list-group list-group-flush">
                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                    <div class="d-flex">
                        No new notification
                    </div>
                </li>
            </ul>
        </li>
        <li class="dropdown-menu-footer border-top">
            <a href="{{ url('notification') }}" class="dropdown-item d-flex justify-content-center p-3">
                View all notifications
            </a>
        </li>
    </ul>
</li>
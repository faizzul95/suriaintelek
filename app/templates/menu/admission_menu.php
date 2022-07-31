<!-- Only for Admission -->

<?php if (session()->get('roleID') == 3) : ?>
    <!-- application -->
    <li class="menu-item <?= ($currentSidebar == 'application') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
            <div>Applications</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?= ($currentSubSidebar == 'allApp') ? 'active' : '' ?>">
                <a href="{{ url('admission/all') }}" class="menu-link">
                    <div>
                        All Application
                    </div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'new') ? 'active' : '' ?>">
                <a href="{{ url('admission/new') }}" class="menu-link">
                    <div>
                        New Application
                    </div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'reject') ? 'active' : '' ?>">
                <a href="{{ url('admission/reject') }}" class="menu-link">
                    <div> Rejected Application </div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'approve') ? 'active' : '' ?>">
                <a href="{{ url('admission/approve') }}" class="menu-link">
                    <div> Registration </div>
                </a>
            </li>
        </ul>
    </li>

    <!-- student -->
    <li class="menu-item <?= ($currentSidebar == 'student') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book-reader"></i>
            <div>Student</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?= ($currentSubSidebar == 'allStud') ? 'active' : '' ?>">
                <a href="{{ url('student/all') }}" class="menu-link">
                    <div>
                        All Student
                    </div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'enrol') ? 'active' : '' ?>">
                <a href="{{ url('student/enrol') }}" class="menu-link">
                    <div>
                        Enrolled Student
                    </div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'withdraw') ? 'active' : '' ?>">
                <a href="{{ url('student/withdraw') }}" class="menu-link">
                    <div> Withdraw Student </div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'graduate') ? 'active' : '' ?>">
                <a href="{{ url('student/graduate') }}" class="menu-link">
                    <div> Graduate Student </div>
                </a>
            </li>
        </ul>
    </li>

    <!-- attendance -->
    <li class="menu-item <?= ($currentSidebar == 'attendance') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
            <div>Attendance</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?= ($currentSubSidebar == 'enrol') ? 'active' : '' ?>">
                <a href="{{ url('attendance/report') }}" class="menu-link">
                    <div>
                        Attendance Report
                    </div>
                </a>
            </li>
        </ul>
    </li>

    <!-- billing -->
    <li class="menu-item <?= ($currentSidebar == 'billing') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class='menu-icon tf-icons bx bx-food-menu'></i>
            <div data-i18n="Invoice">Billing</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?= ($currentSubSidebar == 'invoice') ? 'active' : '' ?>">
                <a href="{{ url('billing/invoice') }}" class="menu-link">
                    <div data-i18n="List">Invoice</div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'receipt') ? 'active' : '' ?>">
                <a href="{{ url('billing/receipt') }}" class="menu-link">
                    <div data-i18n="Preview">Payment</div>
                </a>
            </li>
        </ul>
    </li>

    <li class="menu-item <?= ($currentSidebar == 'user') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Users">Users</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?= ($currentSubSidebar == 'parent') ? 'active' : '' ?>">
                <a href="{{ url('user/parent') }}" class="menu-link">
                    <div data-i18n="List">Parents</div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'teacher') ? 'active' : '' ?>">
                <a href="{{ url('teacher') }}" class="menu-link">
                    <div>Teachers</div>
                </a>
            </li>
        </ul>
    </li>

<?php endif; ?>
<!-- Only for administrator -->

<?php if (session()->get('roleID') == 2) : ?>
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

    <!-- Report Card -->
    <li class="menu-item <?= ($currentSidebar == 'reportcard') ? 'active' : '' ?>">
        <a href="{{ url('reportcard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-message-square-edit"></i>
            <div> Report Card </div>
        </a>
    </li>

    <!-- attendance -->
    <li class="menu-item <?= ($currentSidebar == 'attendance') ? 'active' : '' ?>">
        <a href="{{ url('attendance/report') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
            <div> Attendance </div>
        </a>
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
            <li class="menu-item <?= ($currentSubSidebar == 'item_fee') ? 'active' : '' ?>">
                <a href="{{ url('settings/billing') }}" class="menu-link">
                    <div>Configuration</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- user -->
    <li class="menu-item <?= ($currentSidebar == 'user') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Users">Users</div>
        </a>
        <ul class="menu-sub">
            <!-- <li class="menu-item <?= ($currentSubSidebar == 'allUser') ? 'active' : '' ?>">
                <a href="{{ url('user/all') }}" class="menu-link">
                    <div>All Users</div>
                </a>
            </li> -->
            <li class="menu-item <?= ($currentSubSidebar == 'teacher') ? 'active' : '' ?>">
                <a href="{{ url('teacher') }}" class="menu-link">
                    <div>Teachers</div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'parent') ? 'active' : '' ?>">
                <a href="{{ url('user/parent') }}" class="menu-link">
                    <div data-i18n="List">Parents</div>
                </a>
            </li>
        </ul>
    </li>

    <!-- System Configuration -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Configuration</span></li>
    <!-- Settings -->
    <li class="menu-item <?= ($currentSidebar == 'settings') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-copy"></i>
            <div data-i18n="Cards">Settings</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?= ($currentSubSidebar == 'academic') ? 'active' : '' ?>">
                <a href="{{ url('settings/academic') }}" class="menu-link">
                    <div>Academic Year</div>
                </a>
            </li>
            <!-- <li class="menu-item <?= ($currentSubSidebar == 'term') ? 'active' : '' ?>">
                <a href="{{ url('settings/term') }}" class="menu-link">
                    <div>Term</div>
                </a>
            </li> -->
            <li class="menu-item <?= ($currentSubSidebar == 'level') ? 'active' : '' ?>">
                <a href="{{ url('settings/level') }}" class="menu-link">
                    <div>Level</div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'classroom') ? 'active' : '' ?>">
                <a href="{{ url('settings/classroom') }}" class="menu-link">
                    <div>Classroom</div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'subject') ? 'active' : '' ?>">
                <a href="{{ url('settings/subject') }}" class="menu-link">
                    <div>Subject</div>
                </a>
            </li>
        </ul>
    </li>
    <li class="menu-item <?= ($currentSidebar == 'enrollment') ? 'active' : '' ?>">
        <a href="{{ url('management/enrollment') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-category-alt"></i>
            <div> Management </div>
        </a>
    </li>
    <!-- <li class="menu-item <?= ($currentSidebar == 'content') ? 'active' : '' ?>">
        <a href="{{ url('generalcontent') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-category-alt"></i>
            <div> Template Content </div>
        </a>
    </li> -->

<?php endif; ?>
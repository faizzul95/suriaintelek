<!-- Only for teacher -->
<?php if (session()->get('roleID') == 4) : ?>

    <li class="menu-item <?= ($currentSidebar == 'wards') ? 'active open' : '' ?>">
        <a href="{{ url('student/wards') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div>My student</div>
        </a>
    </li>

    <!-- attendance -->
    <li class="menu-item <?= ($currentSidebar == 'attendance') ? 'active open' : '' ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons fa fa-qrcode" aria-hidden="true"></i>
            <div>Attendance</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item <?= ($currentSubSidebar == 'record') ? 'active' : '' ?>">
                <a href="{{ url('attendance/record') }}" class="menu-link">
                    <div>
                        Record
                    </div>
                </a>
            </li>
            <li class="menu-item <?= ($currentSubSidebar == 'report') ? 'active' : '' ?>">
                <a href="{{ url('attendance/report') }}" class="menu-link">
                    <div>
                        Report
                    </div>
                </a>
            </li>
        </ul>
    </li>

    <!-- Report Card -->
    <li class="menu-item <?= ($currentSidebar == 'reportcard') ? 'active' : '' ?>">
        <a href="{{ url('reportcard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-message-square-edit"></i>
            <div> Assessment </div>
        </a>
    </li>

<?php endif; ?>
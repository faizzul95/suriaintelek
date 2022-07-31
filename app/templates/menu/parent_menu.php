<!-- Only for parent -->
<?php if (session()->get('roleID') == 5) : ?>

    <li class="menu-item <?= ($currentSidebar == 'profile') ? 'active' : '' ?>">
        <a href="{{ url('profile/personal') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div>Profile</div>
        </a>
    </li>


    <!-- <li class="menu-item <?= ($currentSidebar == 'children') ? 'active' : '' ?>">
        <a href="{{ url('student/children') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-group"></i>
            <div>My Children</div>
        </a>
    </li> -->

    <!-- Billing -->
    <li class="menu-item <?= ($currentSidebar == 'billing') ? 'active' : '' ?>">
        <a href="{{ url('billing') }}" class="menu-link">
            <i class="menu-icon tf-icons fas fa-file-invoice"></i>
            <div>Billing</div>
        </a>
    </li>

<?php endif; ?>
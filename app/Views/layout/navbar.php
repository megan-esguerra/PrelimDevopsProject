<nav class="navbar navbar-expand-lg  px-3">
    <div class="container-fluid">
        <input type="text" class="form-control w-25 me-3" placeholder="Search...">
        
        <i class="bi bi-bell fs-4 me-3"></i> <!-- Notification Icon -->

        <!-- User Profile Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url('img/bgimg.png'); ?>" alt="User" class="rounded-circle me-2" width="40" height="40">
                <span>Ann Lee</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end z-10" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

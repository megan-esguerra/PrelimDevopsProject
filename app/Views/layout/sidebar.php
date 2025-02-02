<div id="sidebar" class="sidebar">
    <ul>
        <li class="Ims"><span class="sideLine">|</span> Cat Cafes Inventory System</li>
        <li><a href="<?= base_url('dashboard'); ?>" class="<?= service('request')->getUri()->getPath() == '/dashboard' ? 'active' : '' ?>"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li><a href="#" class="<?= service('request')->getUri()->getPath() == '/stock' ? 'active' : '' ?>"><i class='bx bxs-package'></i>In Stock</a></li>
        <li><a href="<?= base_url('statistics'); ?>" class="<?= service('request')->getUri()->getPath() == '/statistics' ? 'active' : '' ?>"><i class='bx bx-bar-chart-square' style='color:#ffffff' ></i>Statistics</a></li>
        <li><a href="<?= base_url('orders'); ?>" class="<?= service('request')->getUri()->getPath() == '/orders' ? 'active' : '' ?>"><i class='bx bxs-cart-download'></i>Orders</a></li>
        <li><a href="#" class="<?= service('request')->getUri()->getPath() == '/users' ? 'active' : '' ?>"><i class='bx bxs-user-account'></i>Users</a></li>
    </ul>
</div>
<div id="sidebar" class="sidebar">
    <!-- caesaer cipher 6 shift  -->
    <ul>
        <li class="Ims"><span class="sideLine">|</span> Cat Cafes Inventory System</li>
        <li><a href="<?= base_url('dashboard'); ?>" class="<?= service('request')->getUri()->getPath() == '/dashboard' ? 'active' : '' ?>"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li><a href="<?= base_url('statistics'); ?>" class="<?= service('request')->getUri()->getPath() == '/statistics' ? 'active' : '' ?>"><i class='bx bx-bar-chart-square'></i>Statistics</a></li>
        <li><a href="<?= base_url('in_stocks'); ?>" class="<?= service('request')->getUri()->getPath() == '/in_stocks' ? 'active' : '' ?>"><i class='bx bxs-package'></i>In Stock</a></li>
        <li><a href="<?= base_url('orders'); ?>" class="<?= service('request')->getUri()->getPath() == '/orders' ? 'active' : '' ?>"><i class='bx bxs-cart-download'></i>Orders</a></li>

        <?php if (session()->get('role') !== 'Staff') : ?>
            <li><a href="<?= base_url('users'); ?>" class="<?= service('request')->getUri()->getPath() == '/users' ? 'active' : '' ?>"><i class='bx bxs-user-account'></i>Users</a></li>
        <?php endif; ?>
    </ul>
</div>
<div id="sidebar" class="sidebar">
    <ul>
        <li class="Ims"><span class="sideLine">|</span> Cat Cafes Inventory System</li>
        <li><a href="<?= base_url('dashboard'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/dashboard' ? 'active' : '' ?>"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li><a href="<?= base_url('stock'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/stock' ? 'active' : '' ?>"><i class='bx bxs-package'></i>In Stock</a></li>
        <li><a href="<?= base_url('products'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/products' ? 'active' : '' ?>"><i class='bx bxs-shopping-bag'></i>Products</a></li>
        <li><a href="<?= base_url('sales'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/sales' ? 'active' : '' ?>"><i class='bx bx-bar-chart-square' style='color:#ffffff' ></i>Sales</a></li>
        <li><a href="<?= base_url('orders'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/orders' ? 'active' : '' ?>"><i class='bx bxs-cart-download'></i>Orders</a></li>
        <li><a href="<?= base_url('users'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/users' ? 'active' : '' ?>"><i class='bx bxs-user-account'></i>Users</a></li>
    </ul>
</div>
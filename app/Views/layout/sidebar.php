<div id="sidebar" class="sidebar">
    <ul>
        <li class="Ims"><span class="sideLine">|</span> Cat Cafes Inventory System</li>
        <li><a href="<?= base_url('dashboard'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/dashboard' ? 'active' : '' ?>"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
        <li><a href="<?= base_url('stock'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/stock' ? 'active' : '' ?>">In Stock</a></li>
        <li><a href="<?= base_url('products'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/products' ? 'active' : '' ?>">Products</a></li>
        <li><a href="<?= base_url('sales'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/sales' ? 'active' : '' ?>">Sales</a></li>
        <li><a href="<?= base_url('orders'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/orders' ? 'active' : '' ?>">Orders</a></li>
        <li><a href="<?= base_url('users'); ?>" class="<?= service('request')->getUri()->getPath() == '/index.php/users' ? 'active' : '' ?>">Users</a></li>
    </ul>
</div>
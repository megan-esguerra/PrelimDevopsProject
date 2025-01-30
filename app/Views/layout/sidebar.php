<div id="sidebar" class="sidebar">
    <ul>
        <li><a href="<?= base_url('dashboard'); ?>" class="<?= service('request')->getUri()->getPath() == '/dashboard' ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="<?= base_url('stock'); ?>" class="<?= service('request')->getUri()->getPath() == '/stock' ? 'active' : '' ?>">In Stock</a></li>
        <li><a href="<?= base_url('products'); ?>" class="<?= service('request')->getUri()->getPath() == '/products' ? 'active' : '' ?>">Products</a></li>
        <li><a href="<?= base_url('sales'); ?>" class="<?= service('request')->getUri()->getPath() == '/sales' ? 'active' : '' ?>">Sales</a></li>
        <li><a href="<?= base_url('orders'); ?>" class="<?= service('request')->getUri()->getPath() == '/orders' ? 'active' : '' ?>">Orders</a></li>
        <li><a href="<?= base_url('users'); ?>" class="<?= service('request')->getUri()->getPath() == '/users' ? 'active' : '' ?>">Users</a></li>
    </ul>
</div>
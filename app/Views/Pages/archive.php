<h1>Archived Orders</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Supplier</th>
            <th>Items</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['id']) ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= htmlspecialchars($order['supplier_name']) ?></td>
                <td><?= htmlspecialchars($order['items']) ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td>
                    <form action="<?= base_url('orders/restore') ?>" method="post">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


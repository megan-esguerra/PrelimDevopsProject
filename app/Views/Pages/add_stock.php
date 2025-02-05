<div class="container mt-5">
    <h2>Add New Stock</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?= implode('<br>', session()->getFlashdata('errors')) ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('store-stock') ?>" method="post">
        <div class="mb-3">
            <label>Order ID</label>
            <input type="text" name="order_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Product</label>
            <input type="text" name="product" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Sales Channel</label>
            <input type="text" name="sales_channel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Instruction</label>
            <textarea name="instruction" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Items</label>
            <input type="number" name="items" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="In Stock">In Stock</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Stock</button>
        <a href="<?= base_url('instock') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

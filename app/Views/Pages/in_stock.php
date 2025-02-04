<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <div class="main-content">
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <div class="container my-5">
            <h1 class="mb-4">In Stock</h1>

             <!-- Notifications -->
             <?php if (session()->has('success')): ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php elseif (session()->has('error')): ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
                <?php endif; ?>

              
            <!-- Categories Tabs -->
            <ul class="nav nav-tabs" id="categoryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="category1-tab" data-bs-toggle="tab" data-bs-target="#category1" type="button" role="tab" aria-controls="category1" aria-selected="true">Category 1</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="category2-tab" data-bs-toggle="tab" data-bs-target="#category2" type="button" role="tab" aria-controls="category2" aria-selected="false">Category 2</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="category3-tab" data-bs-toggle="tab" data-bs-target="#category3" type="button" role="tab" aria-controls="category3" aria-selected="false">Category 3</button>
                </li>
            </ul>

             <!-- Toolbar -->
             <div class="d-flex justify-content-between mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOrderModal">+ New Stock</button>
            </div>

            <select class="form-select me-2" name="status">
                    <option value="" <?= empty($statusFilter) ? 'selected' : '' ?>>All Status</option>
                    <option value="Pending" <?= ($statusFilter ?? '') == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Completed" <?= ($statusFilter ?? '') == 'Completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="Cancelled" <?= ($statusFilter ?? '') == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>

                 <!-- Orders Table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-truncate" style="max-width: 50px;">Order ID</th>
                        <th class="text-truncate" style="max-width: 40px;">Product</th>
                        <th class="text-truncate" style="max-width: 60px;">Category</th>
                        <th class="text-truncate" style="max-width: 60px;">Sales Channel</th>
                        <th class="text-truncate" style="max-width: 50px;">Instruction</th>
                        <th class="text-truncate" style="max-width: 40px;">Items</th>
                        <th class="text-truncate" style="max-width: 150px;">Status</th>
                    </tr>
                </thead>

             <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

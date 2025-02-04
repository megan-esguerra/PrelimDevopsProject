<?php include(APPPATH . 'Views/layout/Header.php'); ?>
<body>
    <?php include(APPPATH . 'Views/layout/sidebar.php'); ?>

    <div class="main-content">
        <?php include(APPPATH . 'Views/layout/navbar.php'); ?>

        <div class="container my-5">
            <h1 class="mb-4">In Stock</h1>


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

             <!-- Search, Date, and Status Filters -->
             <div class="d-flex align-items-center mt-3">
                <input type="text" class="form-control me-3" placeholder="Quick search" style="max-width: 200px;">
                <input type="date" class="form-control me-3" style="max-width: 150px;">
                <select class="form-select" style="max-width: 150px;">
                    <option selected>Status</option>
                    <option value="in_stock">In Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>
            </div>

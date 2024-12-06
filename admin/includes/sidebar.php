<?php
    // Get the current page name
    $page = basename($_SERVER['SCRIPT_NAME']);
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                
                <a class="nav-link <?= $page == 'index.php' ? 'active' : ''; ?>" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link <?= $page == 'order-create.php' ? 'active' : ''; ?>" href="order-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Create Order
                </a>

                <a class="nav-link <?= $page == 'orders.php' ? 'active' : ''; ?>" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Orders
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>

                <!-- Categories -->
                <a class="nav-link collapsed <?= in_array($page, ['categories-create.php', 'categories.php']) ? 'active' : ''; ?>" 
                    href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseCategories"
                    aria-expanded="false"
                    aria-controls="collapseCategories">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= in_array($page, ['categories-create.php', 'categories.php']) ? 'show' : ''; ?>" 
                     id="collapseCategories" 
                     aria-labelledby="headingOne" 
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'categories-create.php' ? 'active' : ''; ?>" href="categories-create.php">Create Category</a>
                        <a class="nav-link <?= $page == 'categories.php' ? 'active' : ''; ?>" href="categories.php">View Categories</a>
                    </nav>
                </div>

                <!-- Products -->
                <a class="nav-link collapsed <?= in_array($page, ['products-create.php', 'products.php']) ? 'active' : ''; ?>" 
                    href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseProducts"
                    aria-expanded="false"
                    aria-controls="collapseProducts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= in_array($page, ['products-create.php', 'products.php']) ? 'show' : ''; ?>" 
                     id="collapseProducts" 
                     aria-labelledby="headingOne" 
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'products-create.php' ? 'active' : ''; ?>" href="products-create.php">Create Product</a>
                        <a class="nav-link <?= $page == 'products.php' ? 'active' : ''; ?>" href="products.php">View Products</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Manage Users</div>

                <!-- Customers -->
                <a class="nav-link collapsed <?= in_array($page, ['customers-create.php', 'customers.php']) ? 'active' : ''; ?>" 
                    href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseCustomers"
                    aria-expanded="false"
                    aria-controls="collapseCustomers">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Customers
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= in_array($page, ['customers-create.php', 'customers.php']) ? 'show' : ''; ?>" 
                     id="collapseCustomers" 
                     aria-labelledby="headingOne" 
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'customers-create.php' ? 'active' : ''; ?>" href="customers-create.php">Add Customer</a>
                        <a class="nav-link <?= $page == 'customers.php' ? 'active' : ''; ?>" href="customers.php">View Customer</a>
                    </nav>
                </div>

                <!-- Admins -->
                <a class="nav-link collapsed <?= in_array($page, ['admins-create.php', 'admins.php']) ? 'active' : ''; ?>" 
                    href="#"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseAdmins"
                    aria-expanded="false"
                    aria-controls="collapseAdmins">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Admins/Staff
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse <?= in_array($page, ['admins-create.php', 'admins.php']) ? 'show' : ''; ?>" 
                     id="collapseAdmins" 
                     aria-labelledby="headingOne" 
                     data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link <?= $page == 'admins-create.php' ? 'active' : ''; ?>" href="admins-create.php">Add Admin</a>
                        <a class="nav-link <?= $page == 'admins.php' ? 'active' : ''; ?>" href="admins.php">View Admin</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>

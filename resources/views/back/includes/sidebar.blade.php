<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item {{ admin_helper::is_open_menu('dashboard') }}">
                <a href="{{ url('/byte/dashboard') }}" class="nav-link {{ admin_helper::active_menu('dashboard') }} ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item {{ admin_helper::is_open_menu('new_request') }}">
                <a href="{{ url('byte/new_request') }}" class="nav-link {{ admin_helper::active_menu('new_request') }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>New Request <span class="right badge badge-danger">New</span></p>
                </a>
            </li>

            <li class="nav-item {{ admin_helper::is_open_menu('vendors') }}">
                <a href="{{ url('/byte/vendors') }}" class="nav-link {{ admin_helper::active_menu('vendors') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Vendors
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/byte/vendors/all_vendors') }}" class="nav-link {{ admin_helper::active_sub_menu('all_vendors') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/vendors/paid_vendors') }}" class="nav-link {{ admin_helper::active_sub_menu('paid_vendors') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Paid Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/vendors/expire_vendors') }}" class="nav-link {{ admin_helper::active_sub_menu('expire_vendors') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Expired Paid Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/vendors/unpaid_vendors') }}" class="nav-link {{ admin_helper::active_sub_menu('unpaid_vendors') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Un-Paid Vendors</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/byte/vendors/top_vendors') }}" class="nav-link {{ admin_helper::active_sub_menu('top_vendors') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Top Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/vendors/featured_vendors') }}" class="nav-link {{ admin_helper::active_sub_menu('featured_vendors') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Featured Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/vendors/archive_vendors') }}" class="nav-link {{ admin_helper::active_sub_menu('archive_vendors') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Archive Vendors</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ admin_helper::is_open_menu('users') }}">
                <a href="{{ url('/byte/users') }}" class="nav-link {{ admin_helper::active_menu('users') }}">
                    <i class="fas fa-users nav-icon"></i>
                    <p>
                        Bride/Groom
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/byte/users/bride_groom') }}" class="nav-link {{ admin_helper::active_sub_menu('bride_groom') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Bride/Groom</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/users/archive_user') }}" class="nav-link {{ admin_helper::active_sub_menu('archive_user') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Archive Bride/Groom</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/users/reviews') }}" class="nav-link {{ admin_helper::active_sub_menu('reviews') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bride/Groom Review</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ admin_helper::is_open_menu('plans') }}">
                <a href="{{ url('/byte/plans') }}" class="nav-link {{ admin_helper::active_menu('plans') }}">
                    <i class="nav-icon fas fa-table"></i>
                    <p>Plans<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/byte/plans/all_plans') }}" class="nav-link {{ admin_helper::active_sub_menu('all_plans') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Plans</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Archive Plans</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Plans</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ admin_helper::is_open_menu('settings') }}">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        Settings
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Home Page Banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Logo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Limits</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ admin_helper::is_open_menu('leads') }}">
                <a href="{{ url('/byte/leads') }}" class="nav-link {{ admin_helper::active_menu('leads') }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Leads
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/byte/leads/approved') }}" class="nav-link {{ admin_helper::active_sub_menu('approved') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Approved Leads</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/leads/unapproved') }}" class="nav-link {{ admin_helper::active_sub_menu('unapproved') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Un-Approved Leads</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/leads/archive_leads') }}" class="nav-link {{ admin_helper::active_sub_menu('archive_leads') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Archive Leads</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/leads/add_lead') }}" class="nav-link {{ admin_helper::active_sub_menu('add_lead') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Lead</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Addon Leads</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>
                        Contact Form Leads
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Leads</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>
                        Ultra Premium Leads
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Leads</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Lead</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ admin_helper::is_open_menu('query') }}">
                <a href="{{ url('/byte/query') }}" class="nav-link {{ admin_helper::active_menu('query') }}">
                    <i class="nav-icon fas fa-paper-plane"></i>
                    <p>
                        Query
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/byte/query/send_message') }}" class="nav-link {{ admin_helper::active_sub_menu('send_message') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Message Query</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/query/view_contact') }}" class="nav-link {{ admin_helper::active_sub_menu('view_contact') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Contact Query</p>
                        </a>
                    </li>
                </ul>
            </li>

             <li class="nav-item {{ admin_helper::is_open_menu('category') }}">
                <a href="{{ url('/byte/category') }}" class="nav-link {{ admin_helper::active_menu('category') }}">
                    <i class="nav-icon far fa-dot-circle"></i>
                    <p>
                        Category
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/byte/category/all_categories') }}" class="nav-link {{ admin_helper::active_sub_menu('all_categories') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/category/archive_category') }}" class="nav-link {{ admin_helper::active_sub_menu('archive_category') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Archive Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/category/add') }}" class="nav-link {{ admin_helper::active_sub_menu('add') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Category</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ admin_helper::is_open_menu('city') }}">
                <a href="{{ url('/byte/city') }}" class="nav-link {{ admin_helper::active_menu('city') }}">
                    <i class="nav-icon fas fa-city"></i>
                    <p>
                        Cities
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/byte/city/all_cities') }}" class="nav-link {{ admin_helper::active_sub_menu('all_cities') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Cities</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/city/archive_city') }}" class="nav-link {{ admin_helper::active_sub_menu('archive_city') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Archive City</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/byte/city/add') }}" class="nav-link {{ admin_helper::active_sub_menu('add') }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add City</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        Staff
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Employee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add Employee</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-blogger-b"></i>
                    <p>
                        Blog
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Blogs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Real Wedding</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Celebrity Wedding</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fashion Wedding</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                    Testimonial
                </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    About Us
                </p>
                </a>
            </li>   
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>


<?php
    
    $logo_url = plugins_url('../../assets/images/logo.png', __FILE__);
    $current_user = wp_get_current_user();
?>

<?php require_once plugin_dir_path(__FILE__) . '../../assets/css.php'; ?>
<?php // require_once plugin_dir_path(__FILE__) . '../../assets/full-screen.php'; ?>

<div class="wrap">
    <div class="crm-wrap">
        <header>
            <strong class="logo">CRM</strong>
            <div class="by">
                <small>Powered by:</small>
                <img src="<?php echo esc_url($logo_url); ?>" alt="Logo">
            </div>
        </header>
        <div class="options">
            <ul>
                <li>
                    <a href="<?php echo admin_url('admin.php?page=crm-settings'); ?>" class="btn">
                        <span class="iconify" data-icon="material-symbols:settings"></span>
                        <span>CRM Settings</span>
                    </a>
                </li>
                <li>

                    <a href="<?php echo admin_url('admin.php?page=crm'); ?>" class="btn"> <span
                            class="iconify color-green" data-icon="teenyicons:users-solid" data-inline="false"></span>
                        <span>All Contacts</span>
                    </a>

                </li>
                <li>
                    <a href="<?php echo admin_url('admin.php?search_term=Future&page=crm'); ?>" class="btn">
                        <span class="iconify color-orange" data-icon="material-symbols:person-outline-rounded"
                            data-inline="false"></span>
                        <span>Future</span>
                    </a>
                </li>
                <li>
                    <button class="btn load-block" data-block="">
                        <span class="iconify color-red" data-icon="material-symbols:person-outline-rounded"
                            data-inline="false"></span>
                        <span>Pipeline</span>
                    </button>
                </li>
                <li>
                    <button class="btn load-block" data-block="">
                        <span class="iconify color-yellow" data-icon="material-symbols-light:folder-open"
                            data-inline="false"></span>
                        <span>Attendance</span>
                    </button>
                </li>
                <li>
                    <a href="<?php echo admin_url('admin.php?page=crm-categories'); ?>" class="btn">
                        <span class="iconify color-yellow" data-icon="material-symbols-light:folder-open"
                            data-inline="false"></span>
                        <span>Categories</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo wp_logout_url(); ?>" class="btn">
                        <span class="iconify" data-icon="fluent:sign-out-24-regular" data-inline="false"></span>
                        <span>Logout</span>
                    </a>
                </li>
                <li class='user'>
                    <span><strong>Welcome:</strong> <?php echo $current_user->display_name; ?>!</span>
                </li>
            </ul>
        </div>

        <div class="contents">
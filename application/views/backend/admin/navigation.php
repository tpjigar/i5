<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url();?>uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        
        <li class="<?php
        if ($page_name == 'staff' || $page_name == 'suparAdmin') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('Roles'); ?></span>
            </a>
            <ul>
                <!-- <li class="<?php if ($page_name == 'suparAdmin') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/suparAdmin">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('suparAdmin'); ?></span>
                    </a>
                </li> -->
                <li class="<?php if ($page_name == 'staff') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/staff">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('simple_admin'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="<?php if ($page_name == 'customer') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/customer">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('customer'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'brand') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/brand">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('brand'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'country') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/country">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('country'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'currency') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/currency">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('currency'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/manage_language">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('language'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'category') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/category">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('category'); ?></span>
            </a>
        </li>

        <li class="<?php if ($page_name == 'sub_category') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/sub_category">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('sub_category'); ?></span>
            </a>
        </li>

        <li class="<?php if ($page_name == 'product') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/product">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('product'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'email_template') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/email_template">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('email_template'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'pages') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/pages">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('stastic_pages'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'advertisement') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/advertisement">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('advertisement'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'seo_meta') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/seo_meta">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('dynamic_SEO'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'paidCustomer') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/paidCustomer">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('paid_customer'); ?></span>
            </a>
        </li>


       <li class="<?php
        if ( $page_name == 'faq') 
            echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('contents'); ?></span>
            </a>
            <ul>
              
                <li class="<?php if ($page_name == 'faq') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/faq">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('faq'); ?></span>
                    </a>
                </li>
               
            </ul>
        </li>


        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ) echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                
            </ul>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
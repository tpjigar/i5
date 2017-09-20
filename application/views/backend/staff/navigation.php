<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
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

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- <li class="<?php if ($page_name == 'customer') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/customer">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('customer'); ?></span>
            </a>
        </li> -->
        <!-- <li class="<?php if ($page_name == 'brand') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/brand">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('brand'); ?></span>
            </a>
        </li> -->
        <li class="<?php if ($page_name == 'country') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/country">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('country'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'currency') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/currency">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('currency'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/manage_language">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('language'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'category') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/category">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('category'); ?></span>
            </a>
        </li>

        <li class="<?php if ($page_name == 'sub_category') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/sub_category">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('sub_category'); ?></span>
            </a>
        </li>

        <!-- <li class="<?php if ($page_name == 'product') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/product">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('product'); ?></span>
            </a>
        </li> -->
        <!-- <li class="<?php if ($page_name == 'email_template') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/email_template">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('email_template'); ?></span>
            </a>
        </li> -->
        <!-- <li class="<?php if ($page_name == 'pages') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/pages">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('stastic_pages'); ?></span>
            </a>
        </li> -->
        <!-- <li class="<?php if ($page_name == 'advertisement') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/advertisement">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('advertisement'); ?></span>
            </a>
        </li> -->
        <!-- <li class="<?php if ($page_name == 'seo_meta') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/seo_meta">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('dynamic_SEO'); ?></span>
            </a>
        </li> -->
       <!--  <li class="<?php if ($page_name == 'paid_customer') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?staff/paid_customer">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('paid_customer'); ?></span>
            </a>
        </li> -->


       <!-- <li class="<?php
        if ( $page_name == 'faq') 
            echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('contents'); ?></span>
            </a>
            <ul>
              
                <li class="<?php if ($page_name == 'faq') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?staff/faq">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('faq'); ?></span>
                    </a>
                </li>
               
            </ul>
        </li> -->

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
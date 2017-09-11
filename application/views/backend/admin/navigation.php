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

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
        
        
        <li class="<?php if ($page_name == 'staff') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/staff">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('staff'); ?></span>
            </a>
        </li>

        
       <li class="<?php
        if ($page_name == 'category' OR $page_name == 'sub_category' OR $page_name == 'faq' OR $page_name == 'pages' OR $page_name == 'seo') 
            echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('contents'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sub_category') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/sub_category">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sub_category'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'faq') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/faq">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('faq'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'pages') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/pages">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('pages'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'seo') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/seo">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('seo'); ?></span>
                    </a>
                </li>
            </ul>
        </li>


       
        <li class="<?php
        if ($page_name == 'class' || $page_name == 'section') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-flow-tree"></i>
                <span><?php echo get_phrase('voucher'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'class') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/voucher">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('voucher'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'section') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/voucher">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('voucher'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        
        <!-- PAYMENT -->
        <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/invoice">
                <i class="entypo-credit-card"></i>
                <span><?php echo get_phrase('payment'); ?></span>
            </a>
        </li>

        
        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                    $page_name == 'sms_settings')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-lifebuoy"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/sms_settings">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
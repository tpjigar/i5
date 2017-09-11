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

        <!-- STUDENT -->
        <li class="<?php
        if ($page_name == 'student_add' ||
                $page_name == 'student_information' ||
                $page_name == 'student_marksheet')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('student'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <!--li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_add">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('admit_student'); ?></span>
                    </a>
                </li-->

               
                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'student_information') echo 'opened active'; ?> ">
                    <a href="#">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>
                    <!--ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul-->
                    <ul>
	                <?php 
	                $courses = $this->db->get('course')->result_array();
	                foreach ($courses as $row):                
	                $classes = $this->db->get_where('class', array('course_id' => $row['course_id'],'teacher_id'=>$this->session->userdata('teacher_id')))->result_array();
	                    ?>
	                    <li class="<?php if ($page_name == 'student_information' && in_array($class_id , array_column($classes , 'class_id'))) echo 'opened active'; ?>">
	                        <a href="#">
	                            <i class="entypo-dot"></i>
	                            <span><?php echo get_phrase('course'); ?> <?php echo $row['name']; ?></span>
	                        </a>
	                        <ul>
		                        <?php
			                foreach ($classes as $row):
			                    ?>
			                    <li class="<?php if ($page_name == 'student_information' && $class_id == $row['class_id']) echo 'active'; ?>">
			                        <a href="<?php echo base_url(); ?>index.php?teacher/student_information/<?php echo $row['class_id']; ?>/<?php echo $row['course_id']; ?>">
			                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
			                        </a>
			                    </li>
			                <?php endforeach; ?>
		                </ul>
	                    </li>
	                <?php endforeach; ?>                
	            </ul>
                </li>

                <!-- STUDENT MARKSHEET -->
                <!--li class="<?php if ($page_name == 'student_marksheet') echo 'opened active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_marksheet/<?php echo $row['class_id']; ?>">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('student_marksheet'); ?></span>
                    </a>
                    <ul>
<?php $classes = $this->db->get('class')->result_array();
foreach ($classes as $row):
    ?>
                            <li class="<?php if ($page_name == 'student_marksheet' && $class_id == $row['class_id']) echo 'active'; ?>">
                                <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/student_marksheet/<?php echo $row['class_id']; ?>">
                                    <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
                                </a>
                            </li>
<?php endforeach; ?>
                    </ul>
                </li-->
            </ul>
        </li>

        <!-- TEACHER -->
        <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/teacher_list">
                <i class="entypo-users"></i>
                <span><?php echo get_phrase('teacher'); ?></span>
            </a>
        </li>



        <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> ">
            <a href="#">
                <i class="entypo-docs"></i>
                <span><?php echo get_phrase('subject'); ?></span>
            </a>
            <ul>
                <?php 
                $courses = $this->db->get('course')->result_array();
                foreach ($courses as $row):                
                $classes = $this->db->get_where('class', array('course_id' => $row['course_id']))->result_array();
                    ?>
                    <li class="<?php if ($page_name == 'subject' && in_array($class_id , array_column($classes , 'class_id'))) echo 'opened active'; ?>">
                        <a href="#">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('course'); ?> <?php echo $row['name']; ?></span>
                        </a>
                        <ul>
	                        <?php
		                foreach ($classes as $row):
		                    ?>
		                    <li class="<?php if ($page_name == 'subject' && $class_id == $row['class_id']) echo 'active'; ?>">
		                        <a href="<?php echo base_url(); ?>index.php?teacher/subject/<?php echo $row['class_id']; ?>/<?php echo $row['course_id']; ?>">
		                            <span><?php echo get_phrase('class'); ?> <?php echo $row['name']; ?></span>
		                        </a>
		                    </li>
		                <?php endforeach; ?>
	                </ul>
                    </li>
                <?php endforeach; ?>                
            </ul>
        </li>
        
        <!-- CLASS ROUTINE -->
        <li class="<?php if ($page_name == 'class_routine') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?teacher/class_routine">
                <i class="entypo-target"></i>
                <span><?php echo get_phrase('class_routine'); ?></span>
            </a>
             <ul>
                <?php 
                $courses = $this->db->get('course')->result_array();
                foreach ($courses as $row):                
                $classes = $this->db->get_where('class', array('course_id' => $row['course_id']))->result_array();
                    ?>
                    <li class="<?php if ($page_name == 'class_routine' && in_array($class_id , array_column($classes , 'class_id'))) echo 'opened active'; ?>">
                        <a href="#">
                            <i class="entypo-dot"></i>
                            <span><?php echo get_phrase('course'); ?> <?php echo $row['name']; ?></span>
                        </a>
                        <ul>
	                        <?php
		                foreach ($classes as $row1):
		                    ?>
		                    <li class="<?php if ($page_name == 'class_routine' && $class_id == $row1['class_id']) echo 'active'; ?>">
		                        <a href="<?php echo base_url(); ?>index.php?teacher/class_routine/<?php echo $row1['class_id']; ?>">
		                            <span><?php echo get_phrase('class'); ?> <?php echo $row1['name']; ?></span>
		                        </a>
		                    </li>
		                <?php endforeach; ?>
	                </ul>
                    </li>
                <?php endforeach; ?>                
            </ul>
        </li>
        
		<!-- STUDY MATERIAL -->
        <li class="<?php if ($page_name == 'study_material') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/study_material">
                <i class="entypo-book-open"></i>
                <span><?php echo get_phrase('study_material'); ?></span>
            </a>
        </li>

        <!-- DAILY ATTENDANCE -->
        <li class="<?php if ($page_name == 'manage_attendance') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_attendance/<?php echo date("d/m/Y"); ?>">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('daily_attendance'); ?></span>
            </a>

        </li>
        
        <!-- TESTS -->
        <li class="<?php
        if ($page_name == 'test')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('test'); ?></span>
            </a>
            <ul>
                <!--li class="<?php if ($page_name == 'test') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/test">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('test_list'); ?></span>
                    </a>
                </li-->
                <li class="<?php if ($page_name == 'view_test_marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/view_test_marks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('view_test_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'test_marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/test_marks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_test_marks'); ?></span>
                    </a>
                </li>
            </ul>
        </li>


        <!-- EXAMS -->
        <li class="<?php
if ($page_name == 'exam' ||
        $page_name == 'grade' ||
        $page_name == 'marks')
    echo 'opened active';
?> ">
            <a href="#">
                <i class="entypo-graduation-cap"></i>
                <span><?php echo get_phrase('exam'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'view_exam_marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?teacher/view_exam_marks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('view_exam_marks'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'marks') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/marks">
                        <span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks'); ?></span>
                    </a>
                </li>
            </ul>
        </li>


        <!-- LIBRARY -->
        <li class="<?php if ($page_name == 'book') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/book">
                <i class="entypo-book"></i>
                <span><?php echo get_phrase('library'); ?></span>
            </a>
        </li>

        <!-- TRANSPORT -->
        <li class="<?php if ($page_name == 'transport') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/transport">
                <i class="entypo-location"></i>
                <span><?php echo get_phrase('transport'); ?></span>
            </a>
        </li>

        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>
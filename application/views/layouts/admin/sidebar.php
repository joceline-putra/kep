<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="# class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php base_url(); ?>assets/velzon/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php base_url(); ?>assets/velzon/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="# class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php base_url(); ?>assets/velzon/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php base_url(); ?>assets/velzon/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Dasboard Version</span></li>
                <li class="nav-item"><a href="{{ url('/dashboard/1" class="nav-link" data-key="t-dashboard_super"><i class="ri-pie-chart-box-line"></i> Super Administrator</a></li>
                <li class="nav-item"><a href="{{ url('/dashboard/2" class="nav-link" data-key="t-dashboard_super"><i class="ri-pie-chart-box-line"></i> School Admin</a></li>
                <li class="nav-item"><a href="{{ url('/dashboard/4" class="nav-link" data-key="t-dashboard_super"><i class="ri-pie-chart-box-line"></i> Teacher</a></li>
                <li class="nav-item"><a href="{{ url('/dashboard/5" class="nav-link" data-key="t-dashboard_super"><i class="ri-pie-chart-box-line"></i> Student</a></li>                                                
            </ul>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <?php 
                if(!empty($data['menu'])){
                    foreach($data['menu'] as $v){
                        if(count($v['child_menu']) > 0){ // Menu has Child
                        ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#<?php echo $v['menu_link']; ?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?php echo $v['menu_link']; ?>">
                                    <i class="<?php echo $v['menu_icon'];?>"></i> <span data-key="<?php echo $v['menu_name'];?>"><?php echo $v['menu_name'];?></span>
                                </a>
                                <div class="collapse menu-dropdown mega-dropdown-menu" id="<?php echo $v['menu_link']; ?>">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <ul class="nav nav-sm flex-column">                
                                                <?php 
                                                foreach($v['child_menu'] as $i){ ?>
                                                    <li class="nav-item">
                                                        <a href="{{ url('/<?php echo $i['menu_child_link']; ?>" class="nav-link" data-key="t-<?php echo $i['menu_child_name']; ?>"><?php echo $i['menu_child_name']; ?></a>
                                                    </li>
                                                <?php                
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>                    
                            </li>
                        <?php
                        }else{ // Single Menu
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="{{ url('/<?php echo $v['menu_link'];?>">
                                    <i class="<?php echo $v['menu_icon'];?>"></i> <span data-key="<?php echo $v['menu_link'];?>"><?php echo $v['menu_name'];?></span>
                                </a>
                            </li>
                            <?php
                        }  
                    }
                }
                ?>                     
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
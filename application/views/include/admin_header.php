<style>
    body.layout-dark .type-zone, body.layout-dark .custom-form .form-control, body.layout-dark .tagging-area {
        padding-right: 0px; 
        border-radius: 0;
        border: 0;
        border-bottom: 2px solid #616279;
        
    }
    body.layout-dark .type-zone, body.layout-dark .custom-form .form-control, body.layout-dark .custom-form .tagging-area::placeholder{
        text-align: center; 
        font-variant: small-caps;
        letter-spacing: 2px;
    }
</style>

<!-- Navbar (Header) Starts-->
    <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                
                <h3 class="text-info custom-main-url"> 
                    <a href="<?php echo base_url(); ?>" target="_blank"><img src="<?= base_url('images/ekattorer-kotha-logo.png')?>" > </a>
                </h3>
                
                <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a></span>
                <form action="<?php echo base_url('news-filter?news_id')?>"  onsubmit="this.action = this.action + this.news_id.value; " method="get"   role="search" class="navbar-form navbar-right mt-2 custom-form">
                    <div class="position-relative has-icon-right">
                        <input type="text" placeholder="Find News by ID" name="news_id" class="form-control round" autocomplete="off"/>
                     
                    </div>
                </form>
                
            </div>
            <div class="navbar-container">
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-2 d-none d-lg-block">
                            <a id="navbar-fullscreen" href="javascript:;" class="nav-link">
                                <p ><?php echo $user_name; ?></p>
                            </a>
                        </li>
                        
                        <li class="nav-item mr-2 d-none d-lg-block">
                            <a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                                <p class="d-none">fullscreen</p>
                            </a>
                        </li>

                        <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                            <p class="d-none">User Settings</p></a>
                            <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                               <a href="<?php echo base_url('auth/logout'); ?>" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar (Header) Ends-->
<?php $currpage = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME); 
$act = $_GET['act']; ?>
<ul class="sidebar-menu">
  <li class="header">MENU</li>

  <li class="<?php if(strcmp($currpage, "login-users") == 0) { echo "active"; } ?>" >
    <a href="login-users.php" ><i class="fa fa-home" aria-hidden="true"></i> <span>Home</span></a>
  </li>

<!--   <li class="treeview <?php if(strcmp($currpage, "categoria-monopage") == 0) { echo "active"; } ?>">
    <a href="#">
      <i class="fa fa-file-text" aria-hidden="true"></i> <span>Monopage</span> 
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li class="<?php if((strcmp($currpage, "categoria-monopage") == 0) && (strcmp($act, "load") == 0)) { echo "active"; } ?>" ><a href="categoria-monopage.php?act=load"><i class="fa fa-th-list" aria-hidden="true"></i> <span>Lista Rows</span></a></li>
      <li class="<?php if((strcmp($currpage, "categoria-monopage") == 0) && (strcmp($act, "add") == 0)) { echo "active"; } ?>"><a href="categoria-monopage.php?act=add&lingua=<?php echo $_SESSION['predef_lingua']; ?>">
        <i class="fa fa-plus-circle" aria-hidden="true"></i> <span>Aggiungi Row</span></a></li>
    </ul>
  </li> -->

  <li class="treeview <?php if(strcmp($currpage, "categoria-page") == 0) { echo "active"; } ?>">
    <a href="#">
      <i class="fa fa-file-text" aria-hidden="true"></i> <span>Catalogo</span> 
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li class="<?php if((strcmp($currpage, "categoria-page") == 0) && (strcmp($act, "load") == 0)) { echo "active"; } ?>" ><a href="categoria-page.php?act=load"><i class="fa fa-th-list" aria-hidden="true"></i> <span>Lista Contenuti</span></a></li>
      <li class="<?php if((strcmp($currpage, "categoria-page") == 0) && (strcmp($act, "add") == 0)) { echo "active"; } ?>"><a href="categoria-page.php?act=add&lingua=<?php echo $_SESSION['predef_lingua']; ?>">
        <i class="fa fa-plus-circle" aria-hidden="true"></i> <span>Aggiungi Contenuto</span></a></li>
    </ul>
  </li>  

  <li class="<?php if((strcmp($currpage, "categoria-users") == 0) && (strcmp($act, "load") == 0)) { echo "active"; }?>" >
    <a href="categoria-users.php?act=load" >
      <i class="fa fa-users" aria-hidden="true"></i> <span>Utenti iscritti</span>
    </a>
  </li>

    <li class="<?php if((strcmp($currpage, "officina-profile") == 0) || (strcmp($currpage, "categoria-officine") == 0)) { echo "active"; }?>" >
    <a href="categoria-officine.php?act=load" >
      <i class="fa fa-wrench" aria-hidden="true"></i> <span>Officine/Dealers</span>
    </a>
  </li>

  <li class="<?php if(strcmp($currpage, "profile") == 0) { echo "active"; } ?>" >
    <a href="profile.php" >
      <i class="fa fa-user" aria-hidden="true"></i> <span><?php echo $_SESSION['nome_utente']; ?></span>
    </a>
  </li>

  <li class="<?php if(strcmp($currpage, "configuration") == 0) { echo "active"; } ?>" >
    <a href="configuration.php" >
      <i class="fa fa-cogs" aria-hidden="true"></i> <span>Dati globali</span>
    </a>
  </li>

  <li>
    <a href="index.php?act=logout" >
      <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> <span>Logout</span>
    </a>
  </li>
            

            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
            <!-- <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
</ul>
<nav class="navbar navbar-inverse mobile_only">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" onclick="openNav()">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/admin/home" style="padding: 0px;"><image src="/assets/logo.jpg" style="height: 50px;"/></a>
    </div>
  </div>
</nav>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn mobile_only" onclick="closeNav()">&times;</a>
  <a href="/admin/home" style="padding-left: 5px;text-align: center;"><image src="/assets/logo.jpg" style="width: 200px;"/></a>
  <?php if($_SESSION[$app_key]["id"]): ?>
  <a style="padding-left: 5px;text-align: center;"><image src="<?php echo $_SESSION[$app_key]["avatar"]??'https://via.placeholder.com/100' ?>" style="border-radius: 100px;width: 100px; height: 100px" /></a>
  <a style="padding-left: 5px;text-align: center;">Welcome! <br><?php echo $_SESSION[$app_key]["name"] ?></a>
  <?php endif; ?>
  <hr>
  <?php if($_SESSION[$app_key]['p1']): ?>
  <a class="<?php echo $active=='dashboard'?'active':''; ?>" href="/admin/home"><i class="fa fa-dashboard"></i> Dashboard</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p2']): ?>
  <a class="<?php echo $active=='followups'?'active':''; ?>" href="/admin/followups"><i class="fa fa-thumb-tack"></i> Follow Ups</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p3']): ?>
  <a class="<?php echo $active=='completed_clients'?'active':''; ?>" href="/admin/completed_clients"><i class="fa fa-shield"></i> Completed Client</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p4']): ?>
  <a class="<?php echo $active=='ivr_details'?'active':''; ?>" href="/admin/home"><i class="fa fa-phone"></i> IVR Details</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p5']): ?>
  <a class="<?php echo $active=='call_dialer'?'active':''; ?>" href="/admin/home"><i class="fa fa-volume-control-phone"></i> Call Dialer</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p6']): ?>
  <a class="<?php echo $active=='customer_link_shares'?'active':''; ?>" href="/admin/customer_link_shares"><i class="fa fa-link"></i> Customer Link Share</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p7']): ?>
  <a class="<?php echo $active=='mail_box'?'active':''; ?>" href="https://swastiklandsman.com/webmail" target="_blank"><i class="fa fa-envelope"></i> Mail Box</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p8']): ?>
  <a class="<?php echo $active=='report'?'active':''; ?>" href="/admin/report"><i class="fa fa-area-chart"></i> Reports</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p9']): ?>
  <a class="<?php echo $active=='favorites'?'active':''; ?>" href="/admin/favorites"><i class="fa fa-bookmark"></i> Favourites</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p10']): ?>
  <a class="<?php echo $active=='client_meetings'?'active':''; ?>" href="/admin/client_meetings"><i class="fa fa-handshake-o"></i> Client Meeting</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p11']): ?>
  <a class="<?php echo $active=='admins'?'active':''; ?>" href="/admin/admins"><i class="fa fa-users"></i> Admins</a>
  <?php endif; ?>
  <?php if($_SESSION[$app_key]['p12']): ?>
  <a class="<?php echo $active=='settings'?'active':''; ?>" href="/admin/settings"><i class="fa fa-users"></i> Settings</a>
  <?php endif; ?>
  <hr>
  <a class="<?php echo $active=='my_profile'?'active':''; ?>" href="/admin/my_profile"><i class="fa fa-user-circle"></i> My Profile</a>
  <a class="<?php echo $active=='change_password'?'active':''; ?>" href="/admin/change_password"><i class="fa fa-asterisk"></i> Change Password</a>
  <a class="<?php echo $active=='logout'?'active':''; ?>" href="/admin/admin_logout" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><span class="fa fa-sign-out"></span> Logout</a>
  <form id="logout-form" action="/admin/admin_logout" method="POST" style="display: none;">
      <input type="hidden" name="_token" value="<?php echo $rand; ?>">
  </form>
</div>
<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
    $("#mySidenav").css('padding-left',"8px");
    $("#mySidenav").css('padding-right',"8px");
    // document.getElementById("main").style.marginLeft = "0";
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    $("#mySidenav").css('padding-left',"0px");
    $("#mySidenav").css('padding-right',"0px");
    // document.getElementById("main").style.marginLeft = "0";
  }
</script>
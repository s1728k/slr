<nav class="navbar navbar-inverse mobile_only">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" onclick="openNav()">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Get Kash</a>
    </div>
  </div>
</nav>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn mobile_only" onclick="closeNav()">&times;</a>
  <a href="#" style="padding-left: 5px;text-align: center;"><image src="/assets/logo.jpg" style="width: 200px;"/></a>
  <?php if($_SESSION["admin_id"]): ?>
  <a style="padding-left: 5px;text-align: center;"><image src="<?php echo $_SESSION["admin_avatar"]??'https://via.placeholder.com/100' ?>" style="border-radius: 100px;width: 100px; height: 100px" /></a>
  <a style="padding-left: 5px;text-align: center;">Welcome! <br><?php echo $_SESSION["admin_name"] ?></a>
  <?php endif; ?>
  <hr>
  <a class="active" href="/admin/home"><i class="fa fa-dashboard"></i> Dashboard</a>
  <a href="/admin/contacts"><i class="fa fa-handshake-o"></i> Follow Ups</a>
  <a href="/admin/admins"><i class="fa fa-home"></i> Completed Client</a>
  <a href="/admin/loans"><i class="fa fa-phone"></i> IVR Details</a>
  <a href="/admin/payment_history"><i class="fa fa-volume-control-phone"></i> Call Dialer</a>
  <a href="/admin/money_flows"><i class="fa fa-link"></i> Customer Link Share</a>
  <a href="/admin/edit_setting"><i class="fa fa-link"></i> Employee Link Share</a>
  <a href="/admin/edit_setting"><i class="fa fa-envelope"></i> Mail Box</a>
  <a href="/admin/edit_setting"><i class="fa fa-area-chart"></i> Reports</a>
  <a href="/admin/edit_setting"><i class="fa fa-bookmark"></i> Favourites</a>
  <a href="/admin/edit_setting"><i class="fa fa-users"></i> Client Meeting</a>
  <a href="/admin/edit_setting"><i class="fa fa-sign-out"></i> Logout</a>
  <hr>
  <a href="/admin/my_profile">My Profile</a>
  <a href="/admin/change_password">Change Password</a>
  <a href="/admin/logout" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><span class="fa fa-sign-out"></span> Logout</a>
  <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
      <input type="hidden" name="_token" value="<?php echo $rand; ?>">
  </form>
</div>
<script>
  function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
    document.getElementById("main").style.marginLeft = "0";
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
</script>
<!--.page -->
<div role="document" class="page">

  <!-- =========== .l-header ============== -->
  <header role="banner" class="l-header">
  <!-- ===============Title and Slogan and LOGO =============== -->
<div class="header-full">
<div class="row">
  <div class="large-5 columns header-full-title">
  <div class="site-logo wow fadeInUp" data-wow-delay="0.5s">
   <?php if ($linked_logo): print $linked_logo; endif; ?>
   </div>
  </div>
  
  <div class="large-7 columns">
  <nav class="top-nav">
    <ul class="top-nav-social inline-list">
      <li><i class="fi-social-twitter"></i></li>
      <li><i class="fi-social-facebook"></i></li>
      <li><i class="fi-social-google-plus"></i></li>
      <li><i class="fi-social-instagram"></i></li>
      <li><i class="fi-social-linkedin"></i></li>
    </ul>
    <div class="login-Block"><a href="user/login">Login</a></div>
    <div class="login-Block">Search</div>
  </nav>
  </div>
</div>
</div>
<!-- =============== End Title and Slogan and LOGO =============== -->

<!-- ================= Top Bar Menu Header ================== -->
  <header role="banner" class="l-header">

    <?php if ($top_bar): ?>
      <!--.top-bar -->
      <?php if ($top_bar_classes): ?>
        <div class="<?php print $top_bar_classes; ?>">
      <?php endif; ?>
      <nav class="top-bar" data-topbar <?php print $top_bar_options; ?>>
        <ul class="title-area">
          <li class="name"><h1><?php print $linked_site_name; ?></h1></li>
          <li class="toggle-topbar menu-icon">
            <a href="#"><span><?php print $top_bar_menu_text; ?></span></a></li>
        </ul>
        <section class="top-bar-section">
        <ul class="right">
         <li class="has-dropdown">
            <a href="#">Кабинет</a>
            <?php if ($top_bar_secondary_menu) :?>
            <ul class="dropdown">
            <?php print $top_bar_secondary_menu; ?>
           </ul>
           <?php endif; ?>
           </li></ul>
            <!-- Left Nav Section -->
           <ul class="left"> <li>
             <?php if ($top_bar_main_menu) :?>
              <?php print $top_bar_main_menu; ?>
            <?php endif; ?>
             </li></ul>
             <?php if (!empty($page['cart'])): ?>
             <?php print render($page['cart']); ?>
             <?php endif; ?>
          <?//php if ($top_bar_main_menu) : ?>
            <?//php print $top_bar_main_menu; ?>
          <?//php endif; ?>
          <?//php if ($top_bar_secondary_menu) : ?>
            <?//php print $top_bar_secondary_menu; ?>
          <?//php endif; ?>
        </section>
      </nav>
      <?php if ($top_bar_classes): ?>
        </div>
      <?php endif; ?>
      <!--/.top-bar -->
    <?php endif; ?>

    <!--  menu -->
    <?php if ($alt_header): ?>
      <section class="row <?php print $alt_header_classes; ?>">

        <?php if ($alt_main_menu): ?>
          <nav id="main-menu" class="navigation" role="navigation">
            <?php print ($alt_main_menu); ?>
          </nav> <!-- /#main-menu -->
        <?php endif; ?>

        <?php if ($alt_secondary_menu): ?>
          <nav id="secondary-menu" class="navigation" role="navigation">
            <?php print $alt_secondary_menu; ?>
          </nav> <!-- /#secondary-menu -->
        <?php endif; ?>

      </section>
    <?php endif; ?>
    <!-- End  menu -->

    <?php if (!empty($page['header'])): ?>
      <!--.l-header-region -->
      <section class="l-header-region">
        <div class="row">
        <div class="large-12 columns">
          <?php print render($page['header']); ?>
          </div>
        </div>
      </section>
      <!--/.l-header-region -->
    <?php endif; ?>

  </header>
<!-- ================= Top Bar Menu Header ================== -->

  <?php if (!empty($page['featured'])): ?>
    <!--.l-featured -->
    <section class="l-featured row">
      <div class="columns">
        <?php print render($page['featured']); ?>
      </div>
    </section>
    <!--/.l-featured -->
  <?php endif; ?>

  <?php if ($messages && !$zurb_foundation_messages_modal): ?>
    <!--.l-messages -->
    <section class="l-messages row">
      <div class="columns">
        <?php if ($messages): print $messages; endif; ?>
      </div>
    </section>
    <!--/.l-messages -->
  <?php endif; ?>

  <?php if (!empty($page['help'])): ?>
    <!--.l-help -->
    <section class="l-help row">
      <div class="columns">
        <?php print render($page['help']); ?>
      </div>
    </section>
    <!--/.l-help -->
  <?php endif; ?>

  <!--.l-main -->
  <main role="main" class="row l-main">
    <!-- .l-main region -->
    <div class="main large-12 columns">

      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlight panel callout">
          <?php print render($page['highlighted']); ?>
        </div>
      <?php endif; ?>

      <a id="main-content"></a>

      <?php if ($title): ?>
        <?php print render($title_prefix); ?>
        <h1 id="page-title" class="title"><?php print $title; ?></h1>
        <?php print render($title_suffix); ?>
      <?php endif; ?>

      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
        <?php if (!empty($tabs2)): print render($tabs2); endif; ?>
      <?php endif; ?>

      <?php if ($action_links): ?>
        <ul class="action-links">
          <?php print render($action_links); ?>
        </ul>
      <?php endif; ?>

      <?php print render($page['content']); ?>
    </div>
    
  </main>
  <!-- ============== /.l-main =========== -->

  <?php if (!empty($page['triptych_first']) || !empty($page['triptych_middle']) || !empty($page['triptych_last'])): ?>
    <!--.triptych-->
    <section class="l-triptych row">
      <div class="triptych-first medium-4 columns">
        <?php print render($page['triptych_first']); ?>
      </div>
      <div class="triptych-middle medium-4 columns">
        <?php print render($page['triptych_middle']); ?>
      </div>
      <div class="triptych-last medium-4 columns">
        <?php print render($page['triptych_last']); ?>
      </div>
    </section>
    <!--/.triptych -->
  <?php endif; ?>

<!-- =============== Footer four columns .footer-four-columns =============== -->
  <?php if (!empty($page['footer_firstcolumn']) || !empty($page['footer_secondcolumn']) || !empty($page['footer_thirdcolumn']) || !empty($page['footer_fourthcolumn'])): ?>
    <!--.footer-columns -->
    <section class="row l-footer-columns">
      <?php if (!empty($page['footer_firstcolumn'])): ?>
        <div class="footer-first medium-3 columns">
          <?php print render($page['footer_firstcolumn']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_secondcolumn'])): ?>
        <div class="footer-second medium-3 columns">
          <?php print render($page['footer_secondcolumn']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_thirdcolumn'])): ?>
        <div class="footer-third medium-3 columns">
          <?php print render($page['footer_thirdcolumn']); ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($page['footer_fourthcolumn'])): ?>
        <div class="footer-fourth medium-3 columns">
          <?php print render($page['footer_fourthcolumn']); ?>
        </div>
      <?php endif; ?>
    </section>
    
  <?php endif; ?>
 <!-- ===============End /.footer-four-columns =============== -->

 <!-- ================ Section Brands Shop ========== -->
 <section class="brands-shop show-for-medium-up">
 	<div class="row carousel">
 <?php if (!empty($page['carousel'])): ?><div class="large-12 columns"><?php print render($page['carousel']); ?></div><?php endif; ?>
 	</div>
 </section>
 <!-- ================ End Section Brands Shop ========== -->

 <!-- ============= L footer two columns =========== -->
 <section class="l-footer-two-columns">
 	<div class="row subscribe">
 <?php if (!empty($page['subscribe'])): ?><div class="large-6 columns"><?php print render($page['subscribe']); ?></div><?php endif; ?>
 <?php if (!empty($page['subscribe_two'])): ?><div class="large-5 large-offset-1 columns"><?php print render($page['subscribe_two']); ?></div><?php endif; ?>
 	</div>
 </section>
 <!-- ============= End L footer two columns =========== -->

 <!-- ============= Footer .footer =================== -->
  <footer class="footer" role="contentinfo">

  <div class="row">
  <?php if (!empty($page['footer_down_one'])): ?>
  	<div class="large-5 columns footer-down-one wow fadeInLeft" data-wow-delay="1.5s"><?php print render($page['footer_down_one']); ?></div>
  <?php endif; ?>
  <?php if (!empty($page['footer_down_two'])): ?>
  	<div class="large-4 columns"><?php print render($page['footer_down_two']); ?></div>
  <?php endif; ?>
  <?php if (!empty($page['footer_down_three'])): ?>
  	<div class="large-3 columns"><?php print render($page['footer_down_three']); ?></div>
  <?php endif; ?>
  </div>

  <div class="row powered-copy-pay">
    <?php if (!empty($page['footer'])): ?>
      <div class="large-4 columns powered-by">
        <?php print render($page['footer']); ?>
      </div>
    <?php endif; ?>

<?php if (!empty($page['pay'])): ?><div class="large-4 columns pay"><?php print render($page['pay']); ?></div><?php endif; ?>

    <?php if ($site_name) : ?>
      <div class="large-4 columns copyright text-right">
        &copy; <?php print date('Y') . ' ' . $site_name . ' ' . t('All rights reserved.'); ?>
      </div>
    <?php endif; ?>
    </div>
  </footer>
<!-- ============= End Footer .footer =================== -->

  <?php if ($messages && $zurb_foundation_messages_modal): print $messages; endif; ?>
</div>
<!--/.page -->
<?php
  drupal_add_js(path_to_theme() . '/js/wow/wow.min.js');
  drupal_add_js(path_to_theme() . '/js/wow/wowinit.js');
?>

<?php
 drupal_add_css(path_to_theme() . '/css/animate.min.css', array ('group' => CSS_THEME));
 ?>

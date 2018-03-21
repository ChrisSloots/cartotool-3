<nav class="nav-bar">
    <div class="logo">
        <img src="img/logo.png" alt="">
    </div>
    <div class="header-contact">
        <span><?php echo $customer->phonenumber; ?></span>
        <span><a href="mailto:<?php echo $customer->email; ?>" class="mailto"><?php echo $customer->email; ?></a></span>
    </div>
    <div class="breadcrumbs">
        <ul>
            <li><a href="?page=project-overview"><?php echo helper::GetText("HOME"); ?></a></li>
            <?php
                $crumbs = helper::GetBreadCrumbs();
                foreach($crumbs as $crumb)
                {
                    printf('<li><a class="fa fa-angle-right"></a></li><li><a href="%2$s">%1$s</a></li>' . PHP_EOL, $crumb->title, $crumb->link);
                }
            ?>
        </ul>
    </div>
    <div class="account-nav">
        <ul>
            <li><a href="../projects_overview.php"><img src="../<?php echo $user->image; ?>" alt=""/><?php printf('%s %s', $user->first_name, $user->last_name); ?></a></li>
            <li><a href="javascript:logout('../logout.php');" class="fa fa-power-off" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo helper::GetText("LOGOUT"); ?>"></a></li>
            <li><?php echo helper::GetLanguageLinks($language_id); ?></li>
        </ul>
    </div>
</nav>


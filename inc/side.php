<?php
/**
 * side.php
 *
 * Author: pixelcave
 *
 * The side content of the page
 *
 */

?>

<style type="text/css">


#wrapper {
    width:600px;
    margin:0 auto; /*centers the div horizontally in all browsers (except IE)*/
    background:#fff;
    text-align:left; /*resets text alignment from body tag */
    border:1px solid #ccc;
    border-top:none;
    padding:25px;
    /*Let's add some CSS3 styles, these will degrade gracefully in older browser and IE*/
    border-radius:0 0 5px 5px;
    -moz-border-radius:0 0 5px 5px;
    -webkit-border-radius: 0 0 5px 5px;
    box-shadow:0 0 5px #ccc;
    -moz-box-shadow:0 0 5px #ccc;
    -webkit-box-shadow:0 0 5px #ccc;
}

#lightbox {
    position:fixed; /* keeps the lightbox window in the current viewport */
    top:100px;
    left:0;
    width:100%;
    height:100%;
    background:url(overlay.png) repeat;
    text-align:center;
}
#lightbox img {
    box-shadow:0 0 25px #111;
    -webkit-box-shadow:0 0 25px #111;
    -moz-box-shadow:0 0 25px #111;
    max-width:300px;
    width:100%;
    height:100%;
}
#lightbox p {
    text-align:right;
    color:#fff;
    margin-right:20px;
    font-size:12px;
}
</style>

<script src="js/jquery-1.6.2.min.js"></script>


<!-- Left Sidebar -->
<!-- In the PHP version you can set the following options from the config file -->
<!-- Add the class .sticky for a sticky sidebar -->
<aside id="page-sidebar" class="nav-collapse collapse<?php if ($template['sidebar'] == 'sticky') echo ' sticky'; ?>">
    <!--
    Wrapper for scrolling functionality
    Used only if the .sticky class added above. You can remove it and you will have a sticky sidebar
    without scrolling enabled when you set the sidebar to be sticky
    -->
    <div class="side-scrollable">
        <!-- Mini Profile -->
       
        <div class="mini-profile">
            <div class="mini-profile-options">
                <a href="javascript:void(0)" class="badge badge-info loading-on" data-toggle="tooltip" data-placement="right" title="Refresh">
                    <i class="icon-refresh"></i>
                </a>
                
                <!-- Modal div is at the bottom of the page before including javascript code, we use .enable-tooltip class for the tooltip because data-toggle is used for modal -->
                <a href="index.php?action=show_profile" class="badge" title="Thông tin cá nhân">
                    <i class="gemicon-small-male"></i>
                </a>
                <a href="index.php?action=logout" class="badge badge-important" data-toggle="tooltip" data-placement="right" title="Đăng xuất">
                    <i class="icon-signout"></i>
                </a>
            </div>
            <!-- <a href=".?action=1">
                <img src=<?php echo get_img($_SESSION['is_valid']); ?> alt="Avatar">
            </a>
 -->

            <!--- Start bootstrap image-->

                <img src=<?php echo get_img($_SESSION['is_valid']);?> alt="Avatar" class="lightbox_trigger">

                <div id="lightbox" style="display:none">
                    
                    <div id="content" >
                        <img src="#"/>
                    </div>
                </div>

                <script>
                jQuery(document).ready(function($) {
                    
                    $('.lightbox_trigger').click(function(e) {
                        
                        //prevent default action (hyperlink)
                        e.preventDefault();

                        //Get clicked link href
                        var image_href = $(this).attr("src");
                        document.getElementById('lightbox').style.display = "visible"; 
                        
                        /*  
                        If the lightbox window HTML already exists in document, 
                        change the img src to to match the href of whatever link was clicked
                        
                        If the lightbox window HTML doesn't exists, create it and insert it.
                        (This will only happen the first time around)
                        */
                        
                        if ($('#lightbox').length > 0) { // #lightbox exists
                            
                            //place href as img src value
                            $('#content').html('<img src="' + image_href + '" />');

                            
                            //show lightbox window - you could use .show('fast') for a transition
                            $('#lightbox').show();
                        }
                        
                        else { //#lightbox does not exist - create and insert (runs 1st time only)
                            
                            //create HTML markup for lightbox window
                            var lightbox = 
                            '<div id="lightbox">' +
                                '<p>Click to close</p>' +
                                '<div id="content">' + //insert clicked link's href into img src
                                    '<img src="' + image_href +'" />' +
                                '</div>' +  
                            '</div>';
                                
                            //insert lightbox HTML into page
                            $('body').append(lightbox);
                        }
                        
                    });
                    
                    //Click anywhere on the page to get rid of lightbox window
                    $('#lightbox').live('click', function() { //must use live, as the lightbox element is inserted into the DOM
                        $('#lightbox').hide();
                    });

                });
                </script>
            

            <!--- End bootstrap image-->
        </div>
        <!-- END Mini Profile -->
        <!-- Sidebar Tabs -->
        <div class="sidebar-tabs-con">
            

            <div class="tab-content">
                <div class="tab-pane active" id="side-tab-menu">
                    <!-- Primary Navigation -->
                    <nav id="primary-nav">
                        <?php if ($primary_nav) { ?>
                        <ul>
                            <?php foreach ($primary_nav as $key => $link) {
                                $link_class = '';

                                // Get link's vital info
                                $url = (isset($link['url']) && $link['url']) ? $link['url'] : '#';
                                $active = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? ' active' : '';
                                $icon = (isset($link['icon']) && $link['icon']) ? '<i class="' . $link['icon'] . '"></i>' : '';

                                // Check if we need add the class active to the li element (only if a sublink is active)
                                $li_active = '';
                                $menu_link = '';

                                if (isset($link['sub']) && $link['sub']) {
                                    foreach ($link['sub'] as $sub_link) {
                                        if (in_array($template['active_page'], $sub_link)) {
                                            $li_active = ' class="active"';
                                            break;
                                        }

                                        // Check and sublinks for active class if they exist
                                        if (isset($sub_link['sub']) && $sub_link['sub']) {
                                            foreach ($sub_link['sub'] as $sub2_link) {
                                                if (in_array($template['active_page'], $sub2_link)) {
                                                    $li_active = ' class="active"';
                                                    break;
                                                }
                                            }
                                        }
                                    }

                                    $menu_link = 'menu-link';
                                }

                                if ($menu_link || $active)
                                    $link_class = ' class="'. $menu_link . $active .'"';
                            ?>
                            <li<?php echo $li_active; ?>>
                                <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php echo $icon . $link['name']; ?></a>
                                <?php if (isset($link['sub']) && $link['sub']) { ?>
                                    <ul>
                                        <?php foreach ($link['sub'] as $sub_link) {
                                            $link_class = '';

                                            // Get sublink's vital info
                                            $url = (isset($sub_link['url']) && $sub_link['url']) ? $sub_link['url'] : '#';
                                            $active = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? ' active' : '';

                                            // Check if we need add the class active to the li element (only if a sublink is active)
                                            $li2_active = '';
                                            $submenu_link = '';

                                            if (isset($sub_link['sub']) && $sub_link['sub']) {
                                                foreach ($sub_link['sub'] as $sub2_link) {
                                                    if (in_array($template['active_page'], $sub2_link)) {
                                                        $li2_active = ' class="active"';
                                                        break;
                                                    }
                                                }

                                                $submenu_link = 'submenu-link';
                                            }

                                            if ($submenu_link || $active)
                                                $link_class = ' class="'. $submenu_link . $active .'"';
                                        ?>
                                        <li<?php echo $li2_active; ?>>
                                            <a href="<?php echo $url; ?>"<?php echo $link_class; ?>><?php echo $sub_link['name']; ?></a>
                                            <?php if (isset($sub_link['sub']) && $sub_link['sub']) { ?>
                                                <ul>
                                                    <?php foreach ($sub_link['sub'] as $sub2_link) {
                                                        // Get vital info of sublinks
                                                        $url = (isset($sub2_link['url']) && $sub2_link['url']) ? $sub2_link['url'] : '#';
                                                        $active = (isset($sub2_link['url']) && ($template['active_page'] == $sub2_link['url'])) ? ' class="active"' : '';
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $url; ?>"<?php echo $active ?>><?php echo $sub2_link['name']; ?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </nav>
                    <!-- END Primary Navigation -->
                </div>
                
            </div>
        </div>
        <!-- END Sidebar Tabs -->
    </div>
    <!-- END Wrapper for scrolling functionality -->
</aside>
<!-- END Left Sidebar -->

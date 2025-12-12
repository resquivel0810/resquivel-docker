<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
         <!-- Load d3.js -->
         <script src="https://d3js.org/d3.v4.min.js"></script>
            <!-- Load the sankey.js function -->
            <script src="https://cdn.jsdelivr.net/gh/holtzy/D3-graph-gallery@master/LIB/sankey.js"></script>
            
   
        <?php
        wp_head();
        ?>
    </head>
    <body>
        <div class="container">
            <header class="header">
                <div class="headerContainer">
                    <a href="<?php echo home_url(); ?>"><h1>
                        resquivel
                    </h1></a>
                    <nav class="header-nav">
                        <?php
                            wp_nav_menu(
                                array(
                                    'menu' => 'primary',
                                    'container' => '',
                                    'theme_location' => 'primary',

                                )
                            );
                        ?>
                    </nav>
                    
                 
                </div>
            </header>
            
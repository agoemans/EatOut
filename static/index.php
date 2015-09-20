<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php
            require 'starter.php';
            echo getClientInfo();
        ?>
        <?php
            require 'helper.php';
            echo getRestaurants();
        ?>
    </body>
</html>
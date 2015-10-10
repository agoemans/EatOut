<!DOCTYPE html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <p>
            <?php
                echo "This will show you a list of vegetarian restaurants in Amsterdam";

            ?>
        </p>
        <p>
            <?php
                require_once(__DIR__.'/src/helper.php');
                $mySearchResult = Shrubbery\getRestaurants();
//                var_dump($mySearchResult[0]);
//                var_dump(get_object_vars($mySearchResult[0]));
                foreach($mySearchResult as $key => $values) {
                    echo '</br>';
                    echo $values->placename;
                    echo '</br>';
                    echo $values->streetname;
                    echo '</br>';
                    echo $values->zipcode;
                    echo '</br>';
                }

            ?>
        </p>
    </body>
</html>
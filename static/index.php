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
                require 'helper.php';
                $mySearchResult = getRestaurants();
//                echo "This is the getrestaurants" . getRestaurants()."end of getrestaurants", '</br>';

//                echo '<pre>'; print_r($mySearchResult); echo '</pre>';
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

//                $output = "<script>console.log('This is the console log' . $mySearchResult  );</script>";



            ?>
        </p>
    </body>
</html>
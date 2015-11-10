            <?php
                require_once(__DIR__ . '/../src/GetJSONList.php');
                require_once(__DIR__.'/../vendor/autoload.php');

                echo "This will show you a list of vegetarian restaurants in Amsterdam";
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
<?php


namespace Route;


/**
 * Class Route
 * @package Route
 *
 * Inspired by the following tutorials/projects:
 * - https://medium.com/the-andela-way/how-to-build-a-basic-server-side-routing-system-in-php-e52e613cf241
 * - https://github.com/steampixel/simplePHPRouter
 * - https://kevinsmith.io/modern-php-without-a-framework
 * - https://steampixel.de/wirklich-einfache-php-templates-so-leicht-trennst-du-dein-html-vom-code-mit-eigenen-views/
 *
 */
class Route
{



    private static $routes = array();


    /**
     * Function used to add a new POST route
     * @param string $expression Route string or regex (i.e. '/omen/' or '/omen/([a-z0-9]+(?:-[a-z0-9]+)*)')
     * @param callable $function Function to call if route with allowed method is found
     * @param bool $query Sends the query data to the function as an array
     */
    public static function post(string $expression, callable $function, $query = TRUE)
    {
        self::$routes[] = [
            'expression' => $expression,
            'function' => $function,
            'method' => 'post',
            'query' => $query
        ];
    }

    /**
     * Function used to add a new GET route
     * @param string $expression Route string or regex (i.e. '/omen/' or '/omen/([a-z0-9]+(?:-[a-z0-9]+)*)')
     * @param callable $function Function to call if route with allowed method is found
     * @param bool $query Sends the query data to the function as an array
     */
    public static function get(string $expression, callable $function, $query = TRUE)
    {
        self::$routes[] = [
            'expression' => $expression,
            'function' => $function,
            'method' => 'get',
            'query' => $query
        ];
    }

    /**
     * Function checks current URL against list of routes
     * if it finds a match, calls the function from the route,
     * with any variables in the URL.
     * The variable in the URL are compared with the parameter
     * defined in the route.
     */
    public static function run()
    {
        // Parse current URL
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);


        // The path
        $path = '/';

        // var_dump($parsed_url['path']);

        // If there is a path
        if (isset($parsed_url['path'])) {

            // If the path is not equal to the base path (including a trailing slash)
                if ('/' != $parsed_url['path']) {
                // Remove slash from end
                $path = rtrim($parsed_url['path'], '/');
            } else {
                $path = $parsed_url['path'];
            }
        }

        // Get current request method (i.e. POST / GET)
        $method = $_SERVER['REQUEST_METHOD'];

       // var_dump($parsed_url);

        // A path match has been found (i.e. '/omens' == '/omens')
        $path_match_found = false;

        // A route match has been found
        $route_match_found = false;


        foreach (self::$routes as $route) {



            // Set up expression to be ready for regex (preg_match)
            $route['expression'] = '^' . $route['expression'] . '$';

            // Check path against expression...i.e. 'does the URL match the expression?'
            if (preg_match('#' . $route['expression'] . '#' . 'i', $path, $matches)) {

                // a path match has been found!
                $path_match_found = true;

                // cast methods to array so that it can go into a foreach loop
                $allowedMethod = $route['method'];


                // Check if method from URL matches method from Route (i.e. get == get)
                if (strtolower($method) == strtolower($allowedMethod)) {


                    // remove the basepath
                    array_shift($matches);

                    $arguments = $matches;

                    if ($route['query'] == true){
                        $queryArray = [];
                        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $queryArray);
                        $arguments[] = $queryArray;
                    }



                    call_user_func_array($route['function'], $arguments);

                    $route_match_found = true;

                    // Do not check other routes
                    break;
                }
            }

            // Break the loop if the first found route is a match
            if ($route_match_found) {
                break;
            }

        }

    }

}
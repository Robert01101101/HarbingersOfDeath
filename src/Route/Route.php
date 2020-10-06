<?php


namespace Route;


class Route
{

    private static $routes = Array();


    /**
     * Function used to add a new route
     * @param string $expression Route string or expression
     * @param callable $function Function to call if route with allowed method is found
     * @param string|array $method Either a string of allowed method or an array with string values
     */
    public static function add(string $expression, callable $function, $method = 'get'){
        self::$routes[] = [
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        ];
    }

    public static function run() {
        // Parse current URL
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        // the path
        $path = '/';

        //var_dump($parsed_url);

        // If there is a path available
        if (isset($parsed_url['path'])) {

            // If the path is not equal to the base path (including a trailing slash)
            if('/' != $parsed_url['path']) {
                // Cut the trailing slash away because it does not matters
                $path = rtrim($parsed_url['path'], '/');
            } else {
                $path = $parsed_url['path'];
            }
        }

        // Get current request method
        $method = $_SERVER['REQUEST_METHOD'];

        $path_match_found = false;

        $route_match_found = false;

        foreach (self::$routes as $route) {

            // If the method matches check the path


            // Add 'find string start' automatically
            $route['expression'] = '^'.$route['expression'];

            // Add 'find string end' automatically
            $route['expression'] = $route['expression'].'$';

            // Check path match
            if (preg_match('#'.$route['expression'].'#'.'i', $path, $matches)) {
                $path_match_found = true;

                // Cast allowed method to array if it's not one already, then run through all methods
                foreach ((array)$route['method'] as $allowedMethod) {
                    // Check method match
                    if (strtolower($method) == strtolower($allowedMethod)) {
                        array_shift($matches); // Always remove first element. This contains the whole string


                        call_user_func_array($route['function'], $matches);

                        $route_match_found = true;

                        // Do not check other routes
                        break;
                    }
                }
            }

            // Break the loop if the first found route is a match
            if($route_match_found){
                break;
            }

        }

    }

}
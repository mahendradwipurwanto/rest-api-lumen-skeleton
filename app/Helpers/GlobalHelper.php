<?php

namespace App\Helpers;

use JetBrains\PhpStorm\NoReturn;

/**
 * GlobalHelper Class
 *
 * This class provides various global helper functions.
 * These functions include retrieving server load and outputting JSON-encoded data.
 *
 * @author mahendradwipurwanto@gmail.com
 */
class GlobalHelper
{

    /**
     * Retrieve Server Load
     *
     * Retrieves the server load percentage. On Windows, it uses WMI command to get load percentage,
     * while on other platforms, it uses sys_getloadavg function.
     *
     * @return int|string Server load percentage if successful, otherwise an empty string.
     *
     * @author mahendradwipurwanto@gmail.com
     */
    public static function get_server_load(): int|string
    {
        // Initialize variable to store the server load
        $load = '';

        // Check if the current OS is Windows
        if (stristr(PHP_OS, 'win')) {
            // Command to retrieve CPU load percentage using WMI on Windows
            $cmd = 'wmic cpu get loadpercentage /all';

            // Execute the command and store the output
            @exec($cmd, $output);

            // If there's any output
            if ($output) {
                // Iterate through each line of the output
                foreach ($output as $line) {
                    // If the line contains only numbers
                    if ($line && preg_match('/^[0-9]+$/', $line)) {
                        // Set the server load to the extracted load percentage
                        $load = $line;
                        // Break the loop as we found the load percentage
                        break;
                    }
                }
            }

        } else {
            // If the OS is not Windows, use sys_getloadavg to retrieve load average
            $sys_load = sys_getloadavg();
            // Get the first value of the load average which represents the load in the last minute
            $load = $sys_load[0];
        }
        // Return the server load percentage
        return $load;
    }

    /**
     * Echo JSON
     *
     * Outputs the provided parameters as JSON and exits the script.
     *
     * @param mixed|null $params Parameters to be encoded as JSON.
     * @return void
     *
     * @author mahendradwipurwanto@gmail.com
     */
    #[NoReturn] public static function ej(mixed $params = null): void
    {
        // Encode the provided parameters as JSON and output them
        echo json_encode($params);
        // Exit the script
        exit();
    }
}

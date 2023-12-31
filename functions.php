<?php



/**
 * Deletes a file anywhere in the web app directory by searching recursively.
 *
 * @param string $filename - The name of the file to be deleted.
 * @return bool - True if the file is found and deleted, false otherwise.
 */
function deleteFileAnywhere($filename) {
    // Get the root directory of the web server
    $rootDirectory = $_SERVER['DOCUMENT_ROOT'];

    // Call the recursive function to search and delete the file
    return deleteFileInDirectory($rootDirectory, $filename);
}





/**
 * Recursively searches for and deletes a file in a given directory.
 *
 * @param string $directory - The directory to start the search from.
 * @param string $filename - The name of the file to be deleted.
 * @return bool - True if the file is found and deleted, false otherwise.
 */
function deleteFileInDirectory($directory, $filename) {
    // Open the directory
    $dir = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
    $iterator = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);

    // Iterate through files and directories
    foreach ($iterator as $fileInfo) {
        // Check if it's a file and matches the filename
        if ($fileInfo->isFile() && $fileInfo->getFilename() === $filename) {
            // Delete the file
            unlink($fileInfo->getPathname());
            return true; // File found and deleted
        }
    }

    return false; // File not found
}









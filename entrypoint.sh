#!/bin/bash

# Start Apache in the background
apache2-foreground &

# Function to reload Apache gracefully
reload_apache() {
    echo "Reloading Apache..."
    apache2ctl graceful
}

# Use `entr` to watch for file changes and reload Apache when changes occur
find /var/www/html -type f | entr -r bash -c "reload_apache"

# Keep the script running indefinitely
tail -f /dev/null

!/bin/bash

mkdir -p images

chmod 777 ./images

curl http://ruslan-website.com/laravel/travel_blog/ajax_php/images.php | tr , \\n | grep 'png' | cut -d '/' -f 2 | cut -d '"' -f 1 | while read name;do echo "Downloading $name";curl -o images/$name "http://ruslan-website.com/laravel/travel_blog/images/$name";done;
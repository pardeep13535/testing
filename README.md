server {
        server_name www.entertainmentonline.in *.entertainmentonline.in entertainmentonline.in;
        listen 80;

        root /usr/share/mysite/;

        # Make site accessible from http://localhost/
#if ($uri ~ (^/browse) {

        if ($uri !~ (^/$)|(^/(favicon.ico|.*\.(json|swf|css|js|xml|mp4|php|jpg|jpeg|png|gif)|(data/|fnk))) ) {
            rewrite ^/(.*)$ /;
        }

        location / {
            autoindex on;
            index public/index.php;
        }

        location ~ \\.php$ {
                fastcgi_index index.php;
                fastcgi_pass localhost:9000;
#               fastcgi_param SCRIPT_FILENAME /etc/nginx/fastcgi_params;
                include      fastcgi_params;
        }

}
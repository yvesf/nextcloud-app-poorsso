# SSO using Nextcloud

This works well with the plugin for embedding external sites: https://apps.nextcloud.com/apps/external

Take care: this app changes your Nextcloud cookie path to `/`.

## Configure nginx

This assumes nextcloud is installed under url prefix `/owncloud/`

```
	# ...
        location @error401 {
                return 302 /owncloud/login;
        }

	# Internal authentication endpoint for users jack, joe and jenny
	location = /poorsso {
		internal;
                proxy_pass https://www.example.com/owncloud/index.php/apps/poorsso/testlogin/jack,joe,jenny;
        }

	# Other SSO protected app
	location /app {
                auth_request /poorsso;
		error_page 401 = @error401;
                proxy_pass http://192.168.1.100/app;
        }
	# ...
```


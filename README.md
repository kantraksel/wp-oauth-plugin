# WP OAuthy

In free time I made little WordPress plugin. It authenticates using OAuth 2.0 standard. Nothing more. Just needs external identity provider.

## Installation and Configuration
1. Clone repository or download current commit (Code -> Download ZIP)
2. Rename oauth_cfg.php.template to oauth_cfg.php
3. Fill the configuration file with proper values
4. Pack to ZIP
5. Upload to your WordPress

## Important notes
- Be sure that configuration file is filled with vaild values. Invalid one creates huge security vulnerability!!!
- Authentication has been tested only for Discord accounts. If it does not work for another provider, create an issue. I have in plans to implement support for popular providers.
- It does not create a new account. It looks up for existing one. If email does not match to any existing account, it will gracefully redirect to WP home page.
- I haven't implemented any widget yet. Authentication starts, when you enter proper URL (default: WORDPRESS_HOME_PAGE/oauth=anyvalue).

## License and other stuff
This plugin is licensed under **MIT License**, which can be found in **LICENSE.md**

A list of things to do is in TODO.md. I may need help. Feel free to pull request!

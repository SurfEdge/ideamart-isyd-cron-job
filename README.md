# I SAY YOU DO Cron Jobs
To run [ISYD](https://isayyoudo.io/) Apps endpoints as a cron job and provide minute by minute requests.

```php
request('https://sv2.ideamarthosting.dialog.lk/APP_NAME/controller.php', 'onthisday');
request('https://sv2.ideamarthosting.dialog.lk/APP_NAME/controller.php', 'daily_news', '20:00');
```
## Setup 
- Add/change the controller links
- Host/Upload the cron.php
- Create a cron job on your server ( * * * * ) every minute
- Done ✅

## Features 🚀
- Per minute refresh
- Supports requests based on a specific time on daily basis
- Colombo Timezone support
- Log all the requests based on the app
- Log of the cron time and time elapsed for an instance

## Sample Apps
https://isayyoudo.io/saybox/thepaparecomdailysports
https://isayyoudo.io/saybox/wikiquote:quoteoftheday


## Contributors
[chamathpali](https://github.com/chamathpali) at [SurfEdge](https://github.com/SurfEdge) 

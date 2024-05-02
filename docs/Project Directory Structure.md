-    ### [Project Directory Structure](Project%20Directory%20Structure.md)
-    ### [Make Usage](Make.md)

<br>

# Project Directory Structure

```
├── app
│   ├── App.php
│   ├── Connection.php
│   ├── Controllers
│   │   ├── Auth
│   │   │   ├── LoginController.php
│   │   │   └── RegisterController.php
│   │   └── DashboardController.php
│   └── Models
│       └── User.php
├── public
│   └── index.php
├── src
│   ├── helpers.php
│   ├── routes.php
│   └── routing
│       ├── Route.php
│       └── Urls.php
└── views
    ├── layouts
    │   ├── foot.php
    │   ├── head.php
    │   └── navigation.php
    ├── auth
    │   ├── login.php
    │   └── register.php
    ├── errors
    │   └── error.php
    ├── dashboard.php
    └── starter.php
```

## App Directory

The <b>app</b> directory contains the core code of the application it consists of two subfolders and two files. You can add more subfolders and class files depending on your need.

-    <b>Controllers</b> - will consist of the applications functionality or logic and returns the web page. See [creating controllers](Make.md#controllers)
-    <b>Models</b> - will consist of classes or entities that communicates with the database server (or performing CRUD operations). See [creating models](Make.md#models)
-    <b>App.php</b> - consists of application custom variables, you may add your own code in this file (as long as the existing code must not be modified).
-    <b>Connection.php</b> - consists of connection to database server.

## Public Directory

The <b>public</b> directory contains the index.php which acts as the single entry point of the application and receives all the incoming requests. This also contains the application's assets such as CSS, JS, and images.

## Src Directory

The src directory contains the helper functions and routes. The routing subfolder contains the routes core code. The routes.php file contains the routing of the application (i.e. get and post request method, urls). The helpers.php file contains the helper functions which is accessible globally.

## Views Directory

The <b>views</b> directory contains the php web pages (user interface) that will be displayed. It has the following subfolders and php files.

-    <b>Layouts</b> - contains the header, footer and navigation that will be included in all parts of the application's user interface.
-    <b>Errors</b> - you may use this folder, if you want to use a customized error pages such as 404 Not Found.
-    <b>starter.php</b> - must not be deleted, this will be used when creating views from the command line. You can edit the starter file depending on the layout you need that will appear in every page. See [creating views](Make.md#views)

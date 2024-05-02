-    ### [Project Directory Structure](Project%20Directory%20Structure.md)
-    ### [Make Usage](Make.md)

<br>

# Make Command Usage

Only available in bash (Linux || Git Bash for Windows). <br><br>
The make command accepts one or two arguments. The first argument is for the directory where you want to create your file and the second is the file name. If no second argument is provided, the make command will consider the first argument as the file name and will be created in the current directory.

## Controllers

By default the controller is created at the app/Controllers directory.

```
./make controller Example ExampleController
```

The above command will create ExampleController at app/Controllers/Example directory.

```
./make controller ExampleController
```

The above command will create ExampleController at app/Controllers directory.

It is recommended to use PascalCasing for Controller names and directories.

## Models

By default the model is created at the app/Models directory.

```
./make model User Post
```

The above command will create Post model at app/Models/User directory.

```
./make model Post
```

The above command will create Post model at app/Models directory.

It is recommended to use PascalCasing for Model names and directories.

## Views

By default the view is created at the views directory. The content of the newly created view will be the same as the content of starter.php

```
./make view auth login
```

The above command will create a login view at views/auth directory.

```
./make view login
```

The above command will create a login view at views directory.

It is recommended to use kebab-case for view names.

## Class

By default a class file is created at the current directory if no second argument is provided.

```
./make class app/Classes ExampleClass
```

The above command will create ExampleClass at app/Classes directory.

It is recommended to use PascalCasing for Class names.

## PHP

By default a php file is created at the current directory if no second argument is provided.

```
./make php views custom-view
```

The above command will create a php file named custom-view at views directory without any contents.

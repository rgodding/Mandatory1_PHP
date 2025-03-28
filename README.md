# Mandatory1_PHP
KEA, Software Udvikling Top Up - Spring 2025... Mandatory 1 aflevering

## TODO
1. Monolithic Architecture
2. Only HTML, PHP and CSS (css is optional)
3. Use OOP for database interaction and business logic

## Functional Requirements
- Navigation Bar
  - Homepage, Departments, Employees, Projects
- Edit Project page that allows for three different types of operation:
  - Changing the name of the project
  - Adding employees to the project
  - Removing employees from the project
  - TLDR: Post, Put, Delete
- Edit Project can be done by three different forms on the same page (Raw Copy Pasted)
  - To let your script know which form made the call, add a “name” attribute to the submit button, so that the first form would have name=”update_project”, the second one name=”add_employee” and the third one name=”remove_employee”

## Additional Guidance
### Videos
[Introduction and Departments](https://kea.cloud.panopto.eu/Panopto/Pages/Viewer.aspx?id=f4a59fa6-4044-4fd8-a99c-b29500a417b9I)  
[Employees](https://kea.cloud.panopto.eu/Panopto/Pages/Viewer.aspx?id=6eef72dd-11d5-4965-9bb2-b29500a4e3b4)  
[Projects](https://kea.cloud.panopto.eu/Panopto/Pages/Viewer.aspx?id=8345dfee-7d67-45bb-9fbb-b29500a6334f)  
[Further information](https://kea.cloud.panopto.eu/Panopto/Pages/Viewer.aspx?id=5c2ead55-f9ac-4d6d-b580-b29500a6e16d)

## Guides
### Create new views page
1. Start page out with this:
```php
<?php
require_once '../../initialise.php';

$pageTitle = 'insert title here';
include_once ROOT_PATH . '/public/header.php';
include_once ROOT_PATH . '/public/nav.php';
?>
```
2. Insert New page into Nav
# TODO
1. Departments are hardcoded, have them brought from Database into relevant areas of code, so it is dynamic
   1. Add & Edit Employee affected by this
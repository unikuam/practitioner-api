**TASKS**

-   Provide an endpoint to list all profiles &#9745;
-   Paginate it &#9745;
-   Filter by name, location & email &#9745;
-   Provide endpoints for CRUD operations &#9745;
-   Unauthenticated users must only be able to view, search and sort the listings, and authenticated users should be able to perform Create, Update, and Delete actions. &#9744;

## **ASSUMPTIONS**

-   Providing default value of per_page for pagination endpoint as 5.
-   A Name / Title (Required), A location (Required), A description (Required), A profile photo (Optional), A few gallery photos (At least one required), Phone number (Required), Email (Required)
-   Size of uploaded file 2 MB
-   Allowed extensions "jpeg","jpg","png"

## **Things I would have done if giving more time**

-   Peform proper validation for various operations
-   File upload functionality is not working for now
-   Authentication part is remaining. I would have created the users table and make the authentication using JWT.

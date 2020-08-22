## **How to build**

-   Create a Database

    `CREATE DATABASE practitioner;`

-   Import the `practitioner.sql` file into the DB.

-   Add this folder inside wamp/www/ in order to use locally or upload on server and use the endpoints as described below:

## **Endpoint Details**

---

-   List all profiles : /NTP/api/profile/read.php

-   List single profile: /NTP/api/profile/read.php?id=1

-   Paginate the profiles: /NTP/api/profile/paginate.php?page=1&per_page=10

-   Filter the profiles column: NTP/api/profile/filter.php?location=meerut&name=XYZ

    > Here we can use table column as a filter key and by default it will perform AND operation

-   CRUD operation endpoints

    | Operation | EndPoint                    |
    | --------- | --------------------------- |
    | Create    | /NTP/api/profile/create.php |

    ```
    {
        "name": "KRSHNA",
        "location": "Gurgaon",
        "description": "abcd",
        "profile_photo": "dwewewew",
        "phone_number": "9393939393",
        "email": "ewwed@wedwed.com"
     }
    ```

    Update | /NTP/api/profile/update.php

    ```
    {
       "name": "KRSHNAAAAA",
       "location": "Gurgaon",
       "profile_photo": "dwewewew",
       "phone_number": "9393939393",
       "email": "ewwed@wedwed.com",
       "id": 6
    }
    ```

    Delete | /NTP/api/profile/delete.php

    ```
    {
        "id": 6
    }
    ```

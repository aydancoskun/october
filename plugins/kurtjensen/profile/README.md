profile-plugin
===========

## Making your October CMS users more personal.

Provides all your front end users a way to manage their own profiles. Build community inside your site where front end users can access other users contact and profile information for collaboration and communication. Great for clubs, unions, churches, associations, and small businesses. Want your users to get to know each other better? This is a great place to start.




##
## Displaying Basic Info and Basic Info Form In your Pages

The MyInfo component displays basic user information and it provides a form for users to edit their own information. You can add the component to your page and render it with the component tag:

```php
{% component 'MyInfo' %}
```

Component Settings you will want check or set:

* **Show Country Field** - choose if you want to display the country field for the user.
* **Default Country** - select a default country for the form. The user can still select others if Show Country Field is set to yes.


_See also_: Guide for user to upload image from frontend [https://vimeo.com/122505195](https://vimeo.com/122505195)



##
## Displaying Extended Info and Extended Info Form

The Extended Info component displays Extended user information and it provides a form for users to edit their own information. You can add the component to your page and render it with the component tag:

```php
{% component 'ExtendedInfo' %}
```
Component Settings you will want check or set:

* **Form Redirect** - Page to redirect to after submiting edit form.




##
## Creating User Directory Page

The User List component displays a directory of users where you can view all user information. You can add the component to your page and render it with the component tag:

```php
{% component 'UserList' %}
```

Component Settings you will want check or set:

* **Selected User Slug** - ( Optional ) Slug for displaying a single users information.  If used, page will only display user with an id that matches the slug.

* **Show Country Field** - Do you want country fields to show in directory?

* **Default Sort Order** - How users are sorted when page opens.

* **Vcard Page** - Page where the V-card (Add To Contacts) download page is located (See VCard Component below.




##
## Creating a VCard Download Page

The VCard Component component allows your logged in users to download user information to their electronic address books. You can add the component to a blank page and render it with the component tag:

```php
{% component 'VCard' %}
```
You will not want any Layout for this page because it is only for downloading vcards and should not display anything else to user.

Component Settings you will want check or set:

* **Selected User Slug** - Slug for selecting users information to download.

* **Permission For Access** - The permission required to download a vcard (see Frontend Roles Manager plugin by TreeFiction).  
__WARNING__ - If you choose "none required" then anyone can download v-cards even if they are not logged in. 




##
## Creating User Photo Gallery

The Gallery component displays a all the user avatars that have been uploaded by your users. You can add the component to your page and render it with the component tag:

```php
{% component 'Gallery' %}
```

Component Settings you will want check or set:

* **Pictures Per Page** - How many photos do you want to show on a page.



##
##Did you find this plugin useful?##
Please take some time to provide feeback regarding this plugin.  These plugins take many hours to develope and your feedback can be provide significant motivation for coders to make improvements and additional plugins.  Please visit http://octobercms.com/plugin/kurtjensen-profile#reviews and provide your review.

If you need help or are having trouble with my plugins then contact me and I will do my best to resolve your issue and consider your suggestions.  Please give me a chance to make it right before posting a negative review.

Thank you for your patronage.

Sincerely

Kurt Jensen <kjensen@iaff106.com>

Washington State / USA
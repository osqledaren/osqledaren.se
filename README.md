# Osqledaren.se

This is the wordpress theme + plugins running [Osqledaren.se](http://osqledaren.se)

## Setup

Install Wordpress running with a php version > 5.3
Clone git into same directory and activate osqledaren theme + plugins from admin-panel.

### Advertising setup

<<<<<<< HEAD
In the "Ads" settings, create an ad-place (Can be named whatever you like). Inside that field create two ads. Ad with ID 1 will be the banner ad. ID 2 will be the ad further down the frontpage, by the small articles.
=======
Activate plugin osqledaren advertising. The theme has:
```
osq_adv_get_ad("banner"); //At the top of index.php
osq_adv_get_ad("articles"); //Inside the article-list in index.php
```
If you want to add another location manually open "osq-advertising/osq-advertising-adminpage.php" and insert the name of your location in the "$ad_locations" array. It will then be configurable from the admin-panel.

>>>>>>> staging

### Advanced Custom Fields setup
 
Activate and configure field "cred" with Field Type "Text Area". Description for usage should be:
>Skriv typ av kred + likamedtecken + namn på en eller flera personer (separerade med kommatecken). Varje typ ska stå på egen rad. Standardtyper är "Text", "Foto", "Illustration" och "Film". Exempel:
Text = Caroline Arkenson, Sara Edin 

### Contact-form-7 setup
Create new contact form with:
```
[text* your-subject placeholder "Titel"]
[textarea* your-message placeholder "Vad har du på hjärtat?"]
[email* your-email placeholder "Email"]
[submit "Skicka"]
```
 And insert the generated [code] where needed.

### Recommended plugins (not in git)
* Responsive Lightbox
* Disqus

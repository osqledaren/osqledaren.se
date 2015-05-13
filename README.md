# Osqledaren.se

This is the wordpress theme + plugins running [Osqledaren.se](http://osqledaren.se)

## Install on localhost

1. Install mamp and mysequel pro (or other drivers with same purpose)
2. Create a database in mysequel.
3. Install wordpress with same version as osqledaren.se is running in your mamp-folder.
4. Run the wordpress setup and connect it to your local mysequel-database.
5. In the terminal, navigate to your wordpress-folder and clone this repository.
6. Inside wordpress-admin (in the browser), activate osqledaren theme and the right plugins.

## Setup plugins
##### Osqledaren-advertising (in git-repo)
Since the plugin resides in this git, just navigate to plugins in WP-admin and activate it.
In your WP-admin menu you will now see a "Reklam" option that has two fields "banner" and "advertising". The info you insert here is inserted into the theme with this snippet:

``` <?php if (function_exists('osq_adv_get_ad')) osq_adv_get_ad("banner"); ?> ```

If you want to add another add-place manually open osq-advertising/osq-advertising-adminpage.php and insert the name of that location in the ```$ad_locations``` array. It will then be configurable in WP-admin and insertable into the theme with the above snippet.

##### Osqledaren podcasts (in git repo)
Activate in plugin section of wp-admin. The menu item "Podcast" gives you all the needed information to add/delete podcasts. The plugin parses the inserted RSS-feeds once per hour.

### Advanced Custom Fields (in git repo)
 
Activate and configure field "cred" with Field Type "Text Area". Description for usage should be:
>Skriv typ av kred + likamedtecken + namn på en eller flera personer (separerade med kommatecken). Varje typ ska stå på egen rad. Standardtyper är "Text", "Foto", "Illustration" och "Film". Exempel:
'Text = Caroline Arkenson, Sara Edin'

This plugin is responsible for the "cred" that resides in the footer of every article.

### post-reading-time (in git repo)
Activate in wp-admin -> plugins and it will magically just work. This plugin has been translated to swedish from the original english and is therefore not to be updated.
### Plugins used at osqledaren.se (not in git)
* Responsive Lightbox
* Disqus

## Developing workflow
All changes should always be done on the dev branch and thereafter merged into the staging branch to be tested live on our staging server. If no bug is still found the change is to be merged into master and pulled on the master server.

#### Typical workflow:
**Editing on the dev-branch**
1. git checkout dev
2. git pull (make sure you're up to date on the branch)
3. Edit code with your favorite editor.
4. git add -A
5. git status (make sure all files are added and nothing looks funky)
6. git commit -m "COMMIT MESSAGE GOES HERE"
7. git push (pushes the changes to github)

**Merging changes**
1. git checkout dev
2. git pull
3. git checkout staging (switching branch to staging)
4. git pull (make sure staging is up to date aswell)
5. git merge dev (merges the dev branch into staging branch)
6. git push (pushes the changes to staging to github)

To merge changes into master the same workflow is to be used.

### Working with CSS/Javascript

**CSS:**
This repo uses codekit to process all the scss files into one big css file.
1. Install Codekit
2. Active on folder
3. Update Codekit settings with the codekit.config file.
Every time you change a scss file it will be processed and saved according to the codekit-settings.

**Javascript:** See the readme in wp-content/themes/osqledaren/assets/js





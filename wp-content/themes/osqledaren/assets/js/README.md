# Osqledaren Javascript

This theme uses node/npm/grunt in the javascript workflow. 

### Prerequisites

**You need to know how to use the terminal.**

**Node/NPM** - install from nodejs.org 

**grunt-cli** - 'npm install grunt-cli -g'. This installs grunt command line interface globally on your machine. You can now use 'grunt' in the terminal. You first need to install node/npm to be able to install this.

### Working with NPM
NPM is node's package manager. With it you can install packages to your folder from the terminal.

``` npm install PACKAGE-NAME ``` Installs a package and puts it in the node_modules folder.
```npm install PACKAGE-NAME -save``` Like above but also saves it in the "dependencies" field in your package.json file.
```npm install PACKAGE-NAME --save-dev ```Like above but saves it in the "dev-dependencies"-field.

```npm install ``` Installs and syncs all the packages in the package.json file to your respository. This is **ALLWAYS** to be used when you have git pull:ed and you're gonna start working with the javascript.

##### 


### Folder structure
**/compiled** - this is where all the processed files go. You should NEVER edit on a file in here. The html/php should also never import a file that does not live in this folder. If that's the case you've done something wrong.

**/podcast** - all the podcast-page related javascript.

**/standard** - all the "standard" javascript, that is used on every page of this theme.
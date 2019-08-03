# Tonovel

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)

Tonovel is community database system to generate and make reading spread from wordl

  - Based database user community
  - Add reading system and feed mode
  - Groupping based user role

# New Features!

  - Comment system and reply based internal system
  - Kontributor , Diff and more much


You can also:
  - Import and store from Website
  - Change your avatar and your role
  - Export documents as PDF


This text you see here is *actually* written in Markdown! To get a feel for Markdown's syntax, type some text into the left window and watch the results in the right.

### Tech

Dillinger uses a number of open source projects to work properly:
* [Trumboywg] - HTML Editor we use
* [Bootstrap Select] - awesome selection with good perform
* [RatingYO] - Usefully rating and status 
* [Twitter Bootstrap] - great UI boilerplate for modern web apps
* [Laravel] - fast and best perform with PHP framework
* [Mix.JS] - the streaming build system
* [jQuery] - duh u know that

And of course we using Bitbucket on GitHub.

### Installation

Tonovel required packages thats included on composer.json

Install the dependencies and devDependencies and start the server.

```sh
$ mkdir tonovel
$ git clone <this-app>
$ composer update 
$ cp .env.complete to .env
$ mysql/mongosetup db
```

For production environments...

```sh
$ mkdir tonovel
$ git clone <this-app>
$ composer update 
$ cp .env.complete to .env
$ APP_ENV=production
```

### Plugins

We currently dont use plugin but we use other service

| Service | README |
| ------ | ------ |
| Amazon S3 Fire | [plugins/amazon/README.md] [PlGa] |
| Google Analytics | [plugins/googleanalytics/README.md] [PlGa] |


### Development

Want to contribute? Great!


```sh
docker run -d -p 8000:8080 --restart="always" <youruser>/tonovel:${package.json.version}
```

Verify the deployment by navigating to your server address in your preferred browser.

```sh
127.0.0.1:8000
```


### Todos

 - Write MORE Tests
 - Add Night Mode

License
----

MIT

# tonovel

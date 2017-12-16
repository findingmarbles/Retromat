[![Build Status](https://travis-ci.org/findingmarbles/Retromat.svg?branch=master)](https://travis-ci.org/findingmarbles/Retromat)

Retromat
========

Retromat: Create, tweak, print & share plans for (agile) retrospectives.
            A collection of activities / methods to inspire scrummasters
            and facilitators in general

See it live at:
https://plans-for-retrospectives.com

---

# Contact

Retromat is primarily run by me, Corinna Baldauf, so if you've got questions, suggestions,
etc. please get in touch:

* corinna@finding-marbles.com
* @findingmarbles on Twitter


# Contribute

You'd like to get involved with Retromat? Great!

## Submit an activity or photo

The easiest way to contribute is to submit an activity:
https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ

Or send a photo illustrating an activity (see above for contact details).

## Translate

Besides the English original, there's a Spanish, French, German and Dutch version.
Our team of awesome translators:

* Spanish: [Thomas Wallet](http://www.elproximopaso.net/) and [Pedro Ángel Serrano](https://twitter.com/pedroserranot)
* French: [Julien Dubois](http://juliendubois.fr/), [Pierre Martin](https://twitter.com/pierremartin) and [Frank Taillandier](http://frank.taillandier.me/)
* German: [Patrick Zeising](https://twitter.com/peezett)
* Dutch: [Linda van der Pal](https://twitter.com/DuchessFounder)
* Russian: [Anton Skornyakov](http://skornyakov.info/), [Yuliana Stepanova](https://twitter.com/Yuliana_Step), [Alexander Martyushev](http://onagile.ru/team/alex-martyushev/)

Your mother tongue is up there? Join them! For two people it's half the work. Science! ;)

Or "open" your own language.

### Translation How To

Language files reside in the "lang/" directory. There's 2 files per language:

* The "lang/index_*.php"-files contain the general text on the page as PHP variables
* The  "backend/web/static/lang/activities_*.js"-files contain the activities (& phase titles) as a JS array

You don't have to translate all activities at once. Just start at index 0 and work your
way down. The first live version of Retromat had 15 activities. So as soon as you've translated
indexes 0-14, your language will go live :)

The indexes should stay the same across languages, so don't move activities around. Some of the attributes, e.g. 'duration' and 'suitable', never show up on the
page the visitors see. No need to translate those.

Please use HTML entitities for special characters, e.g. &uuml; &ccedil; &ntilde;)

#### Technical setup

To test your translation of the "lang/index_*.php"-file you need a local webserver with PHP installed. Previously it was possible to test translations with PHP only, but [@TimonFiddike](https://twitter.com/TimonFiddike) is currently building some features that are easier to implement in this new way. In the medium term, there will be a web based translation tool for Retromat. If you want to locally test translations NOW and running a local webserver is not an option, please contact Timon and let him know your system setup (Windows, Linux, Mac). We'll find a way to make this work for you.

Set up your local webserver to use Retromat/backend/web/ as it's document root. If you need your local webserver for multiple proejcts, the easiest solution is to add a virtual host to your local webserver config (and to your hosts file) so that e.g. http://retromal.local uses Retromat/backend/web/ as it's document root. Retromat enforces https connections only for the live domain (plans-for-retrospectives.com), so http will be enough if you choose a different name for you local installation.

In a terminal run

```
 php index.php en > backend/web/index.html
```

to generate the English page.

Let's say you translate into Chinese and have created "index_cn.php" in the "lang"-directory.
In your terminal run

```
 php index.php cn > backend/web/index_cn.html
```

Then open http://retromal.local/index_cn.html in a browser.

Attention: "lang/activities_cn.php" also has to exist or it won't work. Fortunately it doesn't have to be translated ;)

To test your translation of the "backend/web/static/lang/activities_*.js"-file you need a browser with JS enabled.

I'm aware that this is not super much information, so please don't hesitate to ask any questions.

#### Trouble Shooting

When translating activities:
If no plan appears it's usually an error in the activities array. The number 1 reason is
a missing "," between the properties of an activity entry. Number 2 is an unescaped line
break in a description.

Test in very small steps, because these errors are annoying to track down.

## Contribute something else

You've got another idea? We're all ears! Especially if your idea fits with the overall vision:

### Vision for Retromat

* Be useful
 * For more people => better
* Be pleasant to use
 * Simple interface
 * Consistent
  * Activities are written in short, straightforward language. For the time being this means that I edit all submitted activities.
 * Pretty


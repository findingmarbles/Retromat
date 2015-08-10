Retromat
========

Retromat: Create, tweak, print & share plans for (agile) retrospectives
            A collection of activities / methods to inspire scrummasters
            and facilitators in general

See it live at:
http://plans-for-retrospectives.com (or http://retr-o-mat.com)

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

Besides the English original, there's a Spanish, French, and German version.
Our team of awesome translators:

* Thomas Wallet and Pedro Ángel Serrano - Spanish
* Julien Dubois, Pierre Martin and Frank Taillandier - French
* Patrick Zeising - German
* Linda van der Pal - Dutch

Your mother tongue is up there? Join them! For two people it's half the work. Science! ;)

Or "open" your own language.

### Translation How To

Language files reside in the "lang/" directory. There's 2 files per language:

* The "index_*.php"-files contain the general text on the page as PHP variables
* The  "activities_*.php"-files contain the activities (& phase titles) as a JS array

You don't have to translate all activities at once. Just start at index 0 and work your
way down. The first live version of Retr-O-Mat had 15 activities. So as soon as you've translated
indexes 0-14, your language will go live :)

(The indexes should stay the same across languages, so don't move activities around.
Some of the attributes, e.g. 'duration' and 'suitable', never show up on the
page the visitors see. No need to translate those.)

Please use HTML entitities for special characters (Examples: &uuml; &ccedil; &ntilde;)

#### Technical setup

To test your translation of the "index_*.php"-file you need php installed. In a terminal run

```
 php index.php en > index.html
```

to generate the English page.

Let's say you translate into Chinese and have created "index_cn.php" in the "lang"-directory.
In your terminal run

```
 php index.php cn > index_cn.html
```

Then open index_cn.html in a browser.

(Ah, the file "activities_cn.php" also has to exist or it won't work. Fortunately it
doesn't have to be translated ;)

To test your translatation of the "activities_*.php"-file you need a browser with JS enabled
and either also PHP on the console or you save a local copy of index.html
of the live Retromat version and replace activities in the code of that local copy.

I'm aware that this is not super much information, so please don't hesitate to ask any questions.

#### Trouble Shooting

When translating activities:
If no plan appears it's usually an error in the activities array. The number 1 reason is
a missing "," between the properties of an activity entry. Number 2 is an unescaped line
break in a description.

Test in very small steps, because these errors are annoying to track down.

## Contribute something else

You've got another idea? We're all ears! Especially if your idea fits with the
overall vision:

### Vision for Retr-O-Mat

* Be useful
 * For more people => better
* Be pleasant to use
 * Simple interface
 * Consistent
  * Activities are written in short, straightforward language. For the time
being this means that I edit all submitted activities. I could hand this over
to other people at some point in the future.
 * Pretty


Retromat
========

Retr-O-Mat: Create, tweak, print & share plans for (agile) retrospectives
            A collection of activities / methods to inspire scrummasters
            and facilitators in general

See it live at:
http://plans-for-retrospectives.com (or http://retr-o-mat.com)

---

# Contact

Retr-O-Mat is primarily run by me, Corinna Baldauf, so if you've got questions, suggestions,
etc. please get in touch:

* corinna@finding-marbles.com
* @findingmarbles on Twitter


# Contribute

You'd like to get involved with Retr-O-Mat? Great!

## Submit an activity or photo

The easiest way to contribute is to submit an activity:
https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ

Or send a photo illustrating an activity (see above for contact details).

## Translate

The French translation is already live. Additionally there are a couple of translations
under construction. Our team of awesome translators:

* Pierre Martin and Frank Taillandier - French
* Tobias Ranft and Judith Andresen - German
* Linda van der Pal - Dutch
* Xavier Verges - Spanish (and possibly Catalan)
* Weronika Kedzierska - Polish

Your mother tongue is up there? Join them! For two people it's half the work. Science! ;)

Or "open" your own language.

### Translation How To

Language files reside in the "lang/" directory. There's 2 files per language:

* The "index_*.php"-files contain the general text on the page as PHP variables
* The  "activities_*.php"-files contain the activities (& phase titles) as a JS array

You don't have to translate all activities at once. Just start at index 0 and work your
way down. The first live version of Retr-O-Mat had 15 activities. So as soon as you've translated
indexes 0-14, your language will go live :)

(The indexes should stay the same across language, so don't move activities around.)

Please use HTML entitities for special characters (Examples: &uuml; &ccedil; &ntilde;)

#### Technical setup

To test your translation of the "index_*.php"-file you need a server with PHP. To make the
index.php load your language, you add the parameter "lang" to the URL. Example:
Let's say you translate into Chinese and have created "index_cn.php" in the "lang"-directory.
Then you type into your browser something like:

http://localhost:8080/?lang=cn or
http://localhost:8080/?id=2-6-10-11-15&lang=cn

(Ah, the file "activities_cn.php" also has to exist or it won't work. Fortunately it
doesn't have to be translated ;)

To test your translatation of the "activities_*.php"-file you need a browser with JS enabled
and either also the PHP running server or you save a local copy of index.html
of the live Retr-O-Mat version and replace activities in that local copy.

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
** For more people => better
* Be pleasant to use
** Simple interface
** Consistent
*** Activities are written in short, straightforward language. For the time
being this means that I edit all submitted activities. In the future this
could be handled by a committee at one point.
** Pretty


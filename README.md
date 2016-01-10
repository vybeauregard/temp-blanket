# temp-blanket
### Temperature blanket color range generator for Laravel 5

Here's some background on what a [temperature blanket](http://thecrochetcrowd.com/crochet-temperature-afghans/) is. This app is designed to make selecting colors based on the weekly average temperature drop-dead simple.

#### Installing
After cloning this repo, run `composer install`.

The weather history API used is [World Weather Online](http://www.worldweatheronline.com/api/). You will need to register for an API key to continue.

#### Navigation

`/` will show you this week's average temperature and what color this week's rows will be (in progress).

`/colors` shows you all of the colors you have selected.

`/history` will show you each color so far (todo).

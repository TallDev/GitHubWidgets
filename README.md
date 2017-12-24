# GitHubWidgets
Easy embed GitHub stuff

Use:
  1. Download it (use from the web come soon)
  2. You need the Username from the Account which come in the frame
  3. Embed it like this (You must replace USERNAME to a real name):

```HTML
<iframe src="EmbedGithubUserWidget.php?user=USERNAME&template=TEMPLATEFILE" id="iframe" width="400" height="600" style="border: none;">
```

You also can do it like this:

```HTML
<iframe src="" id="iframe" width="400" height="600" style="border: none;">
```
```JavaScript
document.getElementById('iframe').src = "EmbedGithubUserWidget.php?user=USERNAME&template=TEMPLATEFILE";
```
---
In the next days i will also implement it on [my Web page](https://www.tallerik.de) and widgeds for Organization will come later.
